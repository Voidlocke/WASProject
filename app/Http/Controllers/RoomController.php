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
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'guest_count' => 'required|integer|min:1',
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

    if ($request->has('room_type') && $request->room_type != '') {
        $query->where('type', $request->room_type);
    }

    if ($request->has('guest_count') && $request->guest_count != '') {
        $query->where('maxperson', '>=', $request->guest_count);
    }

    $rooms = $query->get(); // Retrieve filtered rooms

    // Check if the result is empty and pass a message to the view
    $message = $rooms->isEmpty() ? 'No rooms found for the given criteria.' : null;

    return view('rooms', compact('rooms', 'message'));
}
}
