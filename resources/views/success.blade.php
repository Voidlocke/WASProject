@extends('master.layout')

@section('content')
<style>
    .card {
    border: none;
    border-radius: 10px;
}

.card-title {
    font-size: 24px;
    font-weight: bold;
}

.card-text {
    font-size: 18px;
    color: #555;
}

.btn-primary {
    background-color: #f5f2f2;
    border-color: #121212;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
}
</style>
<!-- Hero Section -->
<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Payment</span></p>
                    <h1 class="mb-4 bread">Payment Success</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Success Section -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <div class="card-body text-center">
                    <h2 class="card-title mb-4">Your Payment is Successful!</h2>
                     <p class="card-text mb-4">Thank you for your payment. <br> Your transaction has been completed successfully.</p>
                     <br>
                     <p class="card-text mb-4">
                        <strong>Your Booking ID is: </strong> {{ session('booking_id') }}
                    </p>

                    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
