@extends('master.layout')

@section('content')

<!-- Hero Section -->
<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Payment</span></p>
                    <h1 class="mb-4 bread">Payment</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- flash msg part -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Payment Section -->
<div class="reviews-container">
    <div class="overall-payment">
        <h2>Payment</h2>
        <div class="payment-info">
            <span class="info">Please complete your payment below:</span>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <div class="booking-details">
                <div class="header">
                    <br>
                    <div class="logo">Moonlit Lagoon Hotel</div>

                </div>
                <h3> Your Booking Details</h3>
                <p><strong>Location:</strong> Moonlit Lagoon Hotel, 123 Jalan Lagoon Utama, Sunway City, <br> 47500 Subang Jaya, Selangor, Malaysia </p>
                <p><strong>Check-in:</strong> {{ $data['check_in_date'] }}</p>
                <p><strong>Check-out:</strong> {{ $data['check_out_date'] }}</p>
                <p><strong>Total Length of Stay:</strong> {{ \Carbon\Carbon::parse($data['check_in_date'])->diffInDays(\Carbon\Carbon::parse($data['check_out_date'])) }} nights</p>
                <p><strong>Selection:</strong> 1 Room for {{ $data['guest_count'] }} guests</p>
                <p><strong>Room Type:</strong> {{ $data['room_type'] }}</p>

            </div>
            <div class="payment-summary">
                <br>
                <h3>Payment Summary</h3>
                <p><strong>Subtotal:</strong> MYR {{ $data['price'] * \Carbon\Carbon::parse($data['check_in_date'])->diffInDays(\Carbon\Carbon::parse($data['check_out_date']))}}</p>
                <p><strong>Total Tax:</strong> MYR {{ $data['price'] * 0.06 }}</p>
                <p><strong>Total:</strong> MYR {{ ($data['price'] * \Carbon\Carbon::parse($data['check_in_date'])->diffInDays(\Carbon\Carbon::parse($data['check_out_date'])) )+ ($data['price'] * 0.06) }}</p>
                <br>
                <h3>Cancellation Policy</h3>
                <p><strong>Cancellation Fee:</strong> MYR 600.00</p>
                <p><strong>Refund:</strong> The refund depends on the cancellation policy in the booking terms.</p>
                <p><strong>Contact:</strong> +6013-2322112 (Help)</p>
            </div>
        </div>
    </div>
    <br>
    <div class="review-form">
        <h3>Enter Payment Details</h3>

        {{-- Show all validation errors at the top --}}
    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('payment.submit', ['booking_id' => $data['booking_id']]) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="amount">Amount</label>
                <p><strong>Total:</strong> MYR {{ ($data['price'] * \Carbon\Carbon::parse($data['check_in_date'])->diffInDays(\Carbon\Carbon::parse($data['check_out_date'])) )+ ($data['price'] * 0.06) }}</p>
            </div>




            <div class="form-group">
                <label for="card_name">CardHolder Name</label>
                <input
                    type="text"
                    name="card_name"
                    id="card_name"
                    class="form-control"
                    required
                    value="{{ old('card_name') }}"
                >
                @error('card_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input
                    type="text"
                    name="card_number"
                    id="card_number"
                    class="form-control"
                    placeholder="0000 0000 0000 0000"
                    required
                    maxlength="19"
                    inputmode="numeric"
                    oninput=
                    "
                        let v = this.value.replace(/[^0-9]/g,'').slice(0,16);
                        let parts = v.match(/.{1,4}/g);
                        this.value = parts ? parts.join(' ') : '';
                    "
                    value="{{ old('card_number') }}"
                >
                @error('card_number')
                    <div class="text-danger" style="font-size: 0.9em;">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input
                    type="text"
                    name="expiry_date"
                    id="expiry_date"
                    class="form-control"
                    placeholder="MM/YY"
                    required
                    maxlength="5"
                    inputmode="numeric"
                    oninput=
                    "
                        let v = this.value.replace(/[^0-9]/g,'').slice(0,4);
                        if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2);
                        this.value = v;
                    "
                    value="{{ old('expiry_date') }}"
                >
                @error('expiry_date')
                    <div class="text-danger" style="font-size: 0.9em;">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="ccv">CVV</label>
                <input
                    type="text"
                    name="ccv"
                    id="ccv"
                    class="form-control"
                    required
                    maxlength="3"
                    inputmode="numeric"
                    pattern="\d{3}"
                    value="{{ old('ccv') }}"
                >
                @error('ccv')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>




            <button type="submit" class="btn-post">Make Payment</button>
        </form>
    </div>
</div>

@endsection
