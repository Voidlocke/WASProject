<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        // Fetch all reviews
        $reviews = Review::all();
        $averageRating = $reviews->avg('rating');

        // Fetch the latest booking for each review
        foreach ($reviews as $review) {
            $latestBooking = Booking::where('user_id', $review->user_id)->latest()->first();
            if ($latestBooking) {
                $review->room_type = Room::find($latestBooking->room_id)->type;
                $review->check_in = $latestBooking->check_in_date;
            } else {
                $review->room_type = 'Unknown';
                $review->check_in = 'Unknown';
            }
        }

        return view('reviews', compact('reviews', 'averageRating'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'review_text' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'comfort' => 'required|numeric|min:0|max:5',
            'staff' => 'required|numeric|min:0|max:5',
            'facilities' => 'required|numeric|min:0|max:5',
            'value' => 'required|numeric|min:0|max:5',
        ]);

        $user = Auth::user();
        $userId = $user ? $user->id : 0;
        $userName = $user ? $user->name : 'Anonymous';

        $latestBooking = Booking::where('user_id', $userId)->latest()->first();
        if (!$latestBooking) {
            return redirect()->back()->with('error', 'No booking found for the user.');
        }

        $room = Room::findOrFail($latestBooking->room_id);

        $review = new Review();
        $review->user_id = $userId;
        $review->user_name = $userName;
        $review->rating = $request->input('rating');
        $review->comfort = $request->input('comfort');
        $review->staff = $request->input('staff');
        $review->facilities = $request->input('facilities');
        $review->value = $request->input('value');
        $review->review_text = $request->input('review_text');
        $review->review_date = now();



        $review->save();
        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('edit_review', compact('review'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'review_text' => 'required|string|max:255',
        ]);

        $review = Review::findOrFail($id);
        $review->review_text = $request->input('review_text');
        $review->save();

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        if ($review->property_photos) {
            Storage::delete($review->property_photos);
        }
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully');
    }



}
