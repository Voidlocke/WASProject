<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show()
{
    $bookings = Booking::where('user_id', auth()->id())->get();

    // Fetch the room type for each booking
    foreach ($bookings as $booking) {
        $room = Room::find($booking->room_id);
        $booking->room_type = $room ? $room->type : 'Unknown';  // If no room is found, default to 'Unknown'
    }

    // Pass the bookings to the view
    return view('profile.show', compact('bookings'));;
}

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('status', 'Profile updated successfully.');
    }

    // filepath: /c:/xampp/htdocs/moonlit/app/Http/Controllers/ProfileController.php
public function updateProfilePhoto(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Store the file in the public/images directory
    $fileName = time() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
    $path = $request->file('profile_photo')->move(public_path('images'), $fileName);

    // Save the path to the user's profile
    $user = Auth::user();
    $user->profile_photo_path = 'images/' . $fileName;
    $user->save();

    return back()->with('success', 'Profile photo updated successfully.');
}

// ProfileController.php
public function cancelBooking(Request $request, $booking_id)
    {
        $bookings = Booking::findOrFail($booking_id);
        $bookings->delete();

        return redirect()->route('profile.show')->with('success', 'Your booking has been canceled successfully.');
    }

}

