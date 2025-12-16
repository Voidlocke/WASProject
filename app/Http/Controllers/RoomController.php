<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function index(Request $request)
{
    // Store the search data in the 'search' table
    if ($request->has(['checkin_date', 'checkout_date', 'guest_count'])) {
        $request->validate([
    'checkin_date'  => ['required', 'regex:/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][0-9]|3[01])\/\d{4}$/'],
    'checkout_date' => ['required', 'regex:/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][0-9]|3[01])\/\d{4}$/'],
    'guest_count'   => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        // Generate the next search_id
        $lastId = DB::table('search')->max('search_id') ?? 0;
        $nextId = $lastId + 1;

        $checkinDate = Carbon::createFromFormat('m/d/Y', $request->input('checkin_date'))->format('Y-m-d');
        $checkoutDate = Carbon::createFromFormat('m/d/Y', $request->input('checkout_date'))->format('Y-m-d');

        // Insert search data into the 'search' table
        DB::table('search')->insert([
            'search_id' => $nextId,
            'checkin_date' => $checkinDate,
            'checkout_date' => $checkoutDate,
            'cus_count' => $request->input('guest_count'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Filter rooms based on search criteria
    $query = DB::table('rooms');

    // Whitelist allowed room types
$allowedRoomTypes = [
    'Suite Room',
    'Family Room',
    'Deluxe Room',
    'Classic Room',
    'Superior Room',
    'Luxury Room',
];

// Whitelist allowed guest counts
$allowedGuestCounts = [1, 2, 3, 4, 5, 6];

if ($request->filled('room_type') && in_array($request->room_type, $allowedRoomTypes, true)) {
    $query->where('type', '=', $request->room_type);
}

if ($request->filled('guest_count') && in_array((int)$request->guest_count, $allowedGuestCounts, true)) {
    $query->where('maxperson', '>=', (int)$request->guest_count);
}


    $rooms = $query->get(); // Retrieve filtered rooms

    // Check if the result is empty and pass a message to the view
    $message = $rooms->isEmpty() ? 'No rooms found for the given criteria.' : null;

    return view('rooms', compact('rooms', 'message'));
}
}
