<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreBookingRequest;

class BookingController extends Controller
{
    use AuthorizesRequests;

    protected $fillable = [
        'user_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'guest_count',
        'booking_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function index(Request $request)
    {
        $bookings = Booking::with(['user', 'room'])->get();
        $users = User::all();
        $rooms = Room::where('availability', '>', 0)->get();

        return view('admin', compact('bookings', 'users', 'rooms'));
    }

    /**
     * CUSTOMER BOOKING FLOW
     * Principle #4: Stored Procedure (atomic booking creation + availability decrement)
     */
    public function store(StoreBookingRequest $request)
    {

        $this->authorize('create', Booking::class);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->back()->with('error', 'You must be logged in to book a room.');
        }

        $latestSearch = DB::table('search')->orderBy('search_id', 'desc')->first();
        if (!$latestSearch) {
            return redirect()->back()->with('error', 'No search criteria found.');
        }

        // UI-friendly check first (DB will check again inside the procedure)
        $room = Room::where('room_id', $request->room_id)
            ->where('availability', '>', 0)
            ->first();

        if (!$room) {
            return redirect()->back()->with('error', 'This room is completely booked');
        }

        $bookingId = 'BOOK-' . strtoupper(uniqid());

        // ✅ Stored Procedure call (also parameterized = Principle #2)
        try {
            DB::select('CALL sp_create_booking(?, ?, ?, ?, ?, ?)', [
                $bookingId,
                (int) $userId,
                $room->room_id,
                $latestSearch->checkin_date,
                $latestSearch->checkout_date,
                (int) $latestSearch->cus_count,
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Unable to create booking: ' . $e->getMessage());
        }

        // Retrieve booking created by stored procedure
        $booking = Booking::where('booking_id', $bookingId)->first();
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking created but could not be retrieved.');
        }

        // Refresh room (availability already decreased in DB)
        $room->refresh();

        session([
            'booking_id' => $booking->booking_id,
            'room_id' => $room->room_id,
            'room_type' => $room->type,
            'check_in_date' => $booking->check_in_date,
            'check_out_date' => $booking->check_out_date,
            'price' => $room->prices,
            'guest_count' => $booking->guest_count
        ]);

        return redirect()->route('payment');

    }

    // admin add booking function (jgn edit)
    public function adminStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,room_id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'guest_count' => 'required|integer|',
            'booking_status' => 'nullable|string',
        ]);

        $room = Room::where('room_id', $request->room_id)
            ->where('availability', '>', 0)
            ->first();

        if (!$room) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selected room is fully booked.');
        }

        $booking_id = 'BOOK-' . strtoupper(uniqid());

        Booking::create([
            'booking_id' => $booking_id,
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guest_count' => $request->guest_count,
            'booking_status' => $request->booking_status,
        ]);

        $room->decrement('availability');

        return redirect()->route('admin.index')->with('success', 'Booking added successfully.');
    }

    public function edit($booking_id)
    {
        $booking = Booking::findOrFail($booking_id); // FIXED variable name
        $users = User::all();
        $rooms = Room::all();

        return view('edit-booking', compact('booking', 'users', 'rooms'));
    }

    public function update(Request $request, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id); // FIXED variable name

        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'guest_count' => 'required|integer|min:1',
            'booking_status' => 'nullable|string',
        ]);

        // If room changed, fix availability
        if ($booking->room_id !== $validatedData['room_id']) {

            Room::where('room_id', $booking->room_id)->increment('availability');

            $newRoom = Room::where('room_id', $validatedData['room_id'])
                ->where('availability', '>', 0)
                ->first();

            if (!$newRoom) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Selected room is fully booked.');
            }

            $newRoom->decrement('availability');
        }

        $booking->update($validatedData);

        return redirect()->route('admin.index')->with('success', 'Booking edited successfully.');
    }

    public function destroy(Request $request, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        $room = Room::where('room_id', $booking->room_id)->first();
        if ($room) {
            $room->increment('availability');
        }

        $booking->delete();

        return redirect()->route('admin.index')->with('success', 'Booking deleted successfully.');
    }
}
