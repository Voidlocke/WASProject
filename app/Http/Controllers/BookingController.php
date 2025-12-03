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

class BookingController extends Controller
{
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
        $rooms = Room::all();

        return view('admin', compact('bookings', 'users', 'rooms'));


}

public function store(Request $request)
{
    // Retrieve the authenticated user's ID

    $userId = Auth::id();

    if (!$userId) {
        return redirect()->back()->with('error', 'You must be logged in to book a room.');
    }

    // Fetch the latest search data
    $latestSearch = DB::table('search')->orderBy('search_id', 'desc')->first();

    if (!$latestSearch) {
        return redirect()->back()->with('error', 'No search criteria found.');
    }

    // Fetch the first room as an example (You can change the logic as needed)
    $room = DB::table('rooms')->where('room_id', $request->room_id)->first();

    if (!$room) {
        return redirect()->back()->with('error', 'No rooms available for booking.');
    }

    // Generate a unique booking ID
    $bookingId = 'BOOK-' . strtoupper(uniqid());

    // Create a new booking
    $booking = Booking::create([
        'booking_id' => $bookingId,
        'user_id' => $userId,
        'room_id' => $room->room_id,
        'check_in_date' => $latestSearch->checkin_date,
        'check_out_date' => $latestSearch->checkout_date,
        'guest_count' => $latestSearch->cus_count,
        'booking_status' => 'pending', // Default status
    ]);

    // Store booking data in the session for later use
    session([
        'booking_id' => $booking->booking_id,
        'room_id' => $room->room_id,
        'room_type' => $room->type,
        'check_in_date' => $booking->check_in_date,
        'check_out_date' => $booking->check_out_date,
        'price' => $room->prices,
        'guest_count' => $booking->guest_count
    ]);

    // Redirect to the payment page with the booking details
    return redirect()->route('payment');

}
/*
public function store(Request $request)
{
    $validatedData = $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'check_in_date' => 'required|date',
        'check_out_date' => 'required|date|after:check_in_date',
        'guest_count' => 'required|integer|min:1',
    ]);

    // Get the logged-in user
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'You must be logged in to book a room.');
    }

    // Generate booking ID
    $bookingId = 'BOOK-' . strtoupper(Str::random(8)); // Generate a unique booking ID

    Booking::create([
        'booking_id' => $bookingId,
        'user_id' => $userId,
        'room_id' => $validatedData['room_id'],
        'check_in_date' => $validatedData['check_in_date'],
        'check_out_date' => $validatedData['check_out_date'],
        'guest_count' => $validatedData['guest_count'],
        'booking_status' => 'pending',
    ]);

    return redirect()->route('payment')->with('success', 'Booking successfully created!');
}*/

//admin add booking function (jgn edit)
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
        $booking_id = 'BOOK-' . strtoupper(uniqid());
        $guestCount = $request->input('guest_count', 1); // Default to 1 if not provided
        $bookingStatus = $request->input('booking_status', 'pending'); // Default to 'pending' if not provided

        Booking::create([
            'booking_id' => $booking_id,
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guest_count' => $request->guest_count,
            'booking_status' => $request->booking_status ,
        ]);

        return redirect()->route('admin.index')->with('success', 'Booking added successfully.');
    }

    public function edit($booking_id)
    {
        $bookings = Booking::findOrFail($booking_id);
        $users = User::all();
        $rooms = Room::all();

        return view('edit-booking', compact('booking', 'users', 'rooms'));
    }

    // admin edit booking function (jgn edit)
    public function update(Request $request, $booking_id)
    {
        $bookings = Booking::findOrFail($booking_id);
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'guest_count' => 'required|integer|min:1',
            'booking_status' => 'nullable|string',
        ]);

        $bookings->update([
            'room_id' => $validatedData['room_id'],
            'check_in_date' => $validatedData['check_in_date'],
            'check_out_date' => $validatedData['check_out_date'],
            'guest_count' => $request->input('guest_count'),
            'booking_status' => $request->input('booking_status'),
        ]);

        return redirect()->route('admin.index')->with('success', 'Booking edited successfully.');

    }

    //admin delete booking function (jgn edit)
    public function destroy(Request $request, $booking_id)
    {
        $bookings = Booking::findOrFail($booking_id);
        $bookings->delete();

        return redirect()->route('admin.index')->with('success', 'Booking deleted successfully.');
    }

/*    public function rooms(Request $request)
{
    $query = DB::table('rooms');
    //$query = Room::query(); // Assuming you have a Room model

      // Apply filters if provided
      if ($request->has('room_type') && $request->room_type != '') {
        $query->where('type', $request->room_type);
    }
     // Filter by guest count if provided
    if ($request->has('guest_count') && $request->guest_count != '') {
        $query->where('maxperson', '>=', $request->guest_count);
    }

    $rooms = $query->get(); //Retrieve filtered rooms
    //$rooms = Room::all(); // Fetch all room data

    // Check if the result is empty and pass a message to the view
    $message = $rooms->isEmpty() ? 'No rooms found for the given criteria.' : null;

    return view('rooms', compact('rooms', 'message'));
}*/
}
