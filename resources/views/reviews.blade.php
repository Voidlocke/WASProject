@extends('master.layout')
@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Reviews</span></p>
                    <h1 class="mb-4 bread">Reviews</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="reviews-container">
    <div class="overall-rating">
        <h2>Leave Us A Review</h2>

        <div class="rating-score">
            <div class="score-label">
                <span class="score">{{ number_format($averageRating, 1) }}</span>
                <span class="label">
                    @if ($averageRating >= 4)
                        Excellent
                    @elseif ($averageRating >= 3)
                        Good
                    @else
                        Poor
                    @endif
                </span>
            </div>
            <div class="stars">
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < floor($averageRating))
                        &#9733;
                    @else
                        &#9734;
                    @endif
                @endfor
            </div>
        </div>
    </div>

    <div class="review-form">
        <h3>Tell Us About Your Stay!</h3>
        <p class="desc">We’d love to know how your experience with our hotel was.
            <br> From the moment you checked in to the time you checked out, your feedback matters!
            <br> Share your story – what stood out, what made you smile and how we can make your next visit even better!</p>
        <div class="rating-options">
            <br>
            <p>Rate This Property</p>
            <span>Comfort</span>
            <div class="stars" data-score="0" id="comfort"></div>
            <span>Staff</span>
            <div class="stars" data-score="0" id="staff"></div>
            <span>Facilities</span>
            <div class="stars" data-score="0" id="facilities"></div>
            <span>Value For Money</span>
            <div class="stars" data-score="0" id="value"></div>
            <span>Overall Experience</span>
            <div class="stars" data-score="0" id="rating"></div>
        </div>

        <form action="{{ route('reviews.store') }}" method="POST"enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <input type="hidden" name="rating" id="rating-score" >
            <input type="hidden" name="comfort" id="comfort-score" >
            <input type="hidden" name="staff" id="staff-score" >
            <input type="hidden" name="facilities" id="facilities-score" >
            <input type="hidden" name="value" id="value-score" >
            <br>
            <p>Tell us what you loved and how we can make your next stay even better!</p>
            <textarea name="review_text" placeholder="Your review..." required></textarea>
            {{--<p>What You Don't Like About Your Stay</p>
            <textarea name="negativereview_text" placeholder="Your review..." required></textarea>--}}
            <button type="submit" class="btn-post">Post Review</button>
        </form>
    </div>
    <br/>

</div>
<div class="guest-reviews-container">
    <div class="guest-reviews">
        <h3>Our Guest Reviews</h3>
        <h4>{{ $reviews->count() }} Reviews</h4>
        <p>Here’s What Our Guests Are Saying About Their Stay...</p>
        @foreach ($reviews as $review)
            <div class="guest-review">
                <div class="guest-info">
                    <p>
                        <img src="{{ asset('storage/' . $review->user->profile_photo_path) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">                        <strong>{{ $review->user->name }}</strong> <br> {{ $review->user->email }}
                    </p>
                    <div class="review-text">
                        {{ $review->review_text }}

                    </div>
                    <p>{{ $review->room_type }} <br> {{ $review->check_in }}</p>
                </div>
                <div class="review-meta">
                    <div class="stars">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < floor($review->rating))
                                &#9733;
                            @elseif ($i < ceil($review->rating) && $review->rating - floor($review->rating) >= 0.5)
                                &#9733; <!-- Half star -->
                            @else
                                &#9734;
                            @endif
                        @endfor
                    </div>

                    @if (Auth::check() && Auth::id() == $review->user_id)
                    <div class="review-actions">
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Review</button> <div class="review-date">
                                Posted On {{ $review->review_date->format('j F Y ') }}
                            </div>
                        </form>
                        <form action="{{ route('reviews.edit', $review->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Update</button> </form>
                    </div>
                @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>

    function validateForm() {
        const rating = document.getElementById('rating-score').value;
        const comfort = document.getElementById('comfort-score').value;
        const staff = document.getElementById('staff-score').value;
        const facilities = document.getElementById('facilities-score').value;
        const value = document.getElementById('value-score').value;

        if (!rating || !comfort || !staff || !facilities || !value) {
            alert('Please fill in all the required fields.');
            return false;
        }
        return true;
    }

    $(document).ready(function() {
        $('#rating').raty({
            half: true,
            starType: 'i',
            starOn: 'fa fa-star',
            starHalf: 'fa fa-star-half-o',
            starOff: 'fa fa-star-o',
            click: function(score, evt) {
                $('#rating-score').val(score);
            }
        });

        $('#comfort').raty({
            half: true,
            starType: 'i',
            starOn: 'fa fa-star',
            starHalf: 'fa fa-star-half-o',
            starOff: 'fa fa-star-o',
            click: function(score, evt) {
                $('#comfort-score').val(score);
            }
        });

        $('#staff').raty({
            half: true,
            starType: 'i',
            starOn: 'fa fa-star',
            starHalf: 'fa fa-star-half-o',
            starOff: 'fa fa-star-o',
            click: function(score, evt) {
                $('#staff-score').val(score);
            }
        });

        $('#facilities').raty({
            half: true,
            starType: 'i',
            starOn: 'fa fa-star',
            starHalf: 'fa fa-star-half-o',
            starOff: 'fa fa-star-o',
            click: function(score, evt) {
                $('#facilities-score').val(score);
            }
        });

        $('#value').raty({
            half: true,
            starType: 'i',
            starOn: 'fa fa-star',
            starHalf: 'fa fa-star-half-o',
            starOff: 'fa fa-star-o',
            click: function(score, evt) {
                $('#value-score').val(score);
            }
        });
    });
</script>

@endsection
