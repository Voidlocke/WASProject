@extends('master.layout')

@section('content')

<style>
    body {
       background-color: #f1f0f0;
    }
    .edith2 {
        margin-top: 100px; /* Adjust this value as needed */
    }
    .btn-primary{
        margin-bottom: 100px;
    }
</style>
<div class="container">
    <h2 class="edith2">Edit Review</h2>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="review_text">Tell us what you loved and how we can make your next stay even better!</label>
            <textarea name="review_text" id="review_text" class="form-control" required>{{ $review->review_text }}</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Update Review</button>
    </form>
</div>
@endsection
