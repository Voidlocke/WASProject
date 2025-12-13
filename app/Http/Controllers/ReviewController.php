<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $reviews = Review::with(['booking.room'])->get();
        $averageRating = $reviews->avg('rating');

        return view('reviews', compact('reviews', 'averageRating'));

    }

    public function store(Request $request)
    {
        // Authorization check - verify user can create reviews
        $this->authorize('create', Review::class);

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

        $latestBooking = Booking::where('user_id', $user->id)->latest()->first();
        if (!$latestBooking) {
            return redirect()->back()->with('error', 'No booking found for the user.');
        }

        Review::create([
            'user_id'     => $user->id,
            'user_name'   => $user->name,
            'booking_id'  => $latestBooking->booking_id,
            'rating'      => $request->rating,
            'comfort'     => $request->comfort,
            'staff'       => $request->staff,
            'facilities'  => $request->facilities,
            'value'       => $request->value,
            'review_text' => Str::of($request->review_text)->stripTags(),
            'review_date' => now(),
        ]);
        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        // Authorization check - verify user can update this review
        $this->authorize('update', $review);

        return view('edit_review', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Authorization check - verify user can update this review
        $this->authorize('update', $review);

        $request->validate([
            'review_text' => 'required|string|max:255',
        ]);

        $review->review_text = Str::of($request->review_text)->stripTags();
        $review->save();

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Authorization check - verify user can delete this review
        $this->authorize('delete', $review);

        if ($review->property_photos) {
            Storage::delete($review->property_photos);
        }
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully');
    }



}
