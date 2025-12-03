@extends('master.layout')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
        <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
            <div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Admin</a></span> <span>Page</span></p>
	            <h1 class="mb-4 bread">Admin</h1>
            </div>
        </div>
      </div>
    </div>
  </div>

<div class="container-fluid mt-5">
    <!-- flash msg part -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container-fluid py-5" style="width: 100%; margin: 0; padding: 0;">
    <h2>Guest List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Room</th>
                <th>Room Type</th>
                <th>Price (RM)</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $index => $booking)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $booking->user->id }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->user->email }}</td>
                <td>{{ $booking->room->room_id }}</td>
                <td>{{ $booking->room->type }}</td>
                <td>{{ number_format($booking->room->prices, 2) }}</td>
                <td>{{ $booking->check_in_date }}</td>
                <td>{{ $booking->check_out_date }}</td>
                <td>
                    <!--edit button-->
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editBookingModal-{{ $booking->booking_id }}">Edit</button>
                    <!-- eedit modal -->
                    <div class="modal fade" id="editBookingModal-{{ $booking->booking_id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('bookings.update', $booking->booking_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Booking</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Select Room -->
                                        <div class="mb-3">
                                            <label for="room_id" class="form-label">Room</label>
                                            <select name="room_id" class="form-control" required>
                                                @foreach($rooms as $room)
                                                    <option value="{{ $room->room_id }}" {{ $booking->room->room_id == $room->room_id ? 'selected' : '' }}>
                                                        {{ $room->room_id }} - {{ $room->type }} ({{ number_format($room->prices, 2) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Check-In Date -->
                                        <div class="mb-3">
                                            <label for="check_in_date" class="form-label">Check-In Date</label>
                                            <input type="date" name="check_in_date" class="form-control" value="{{ $booking->check_in_date }}" required>
                                        </div>

                                        <!-- Check-Out Date -->
                                        <div class="mb-3">
                                            <label for="check_out_date" class="form-label">Check-Out Date</label>
                                            <input type="date" name="check_out_date" class="form-control" value="{{ $booking->check_out_date }}" required>
                                        </div>

                                        <!-- Guest Count -->
                                        <div class="mb-3">
                                            <label for="guest_count" class="form-label">Guest Count</label>
                                            <input type="number" name="guest_count" class="form-control" min ="1" value="{{ $booking->guest_count }}" required>
                                        </div>

                                        <!-- Booking Status -->
                                        <div class="mb-3">
                                            <label for="booking_status" class="form-label">Booking Status</label>
                                            <select name="booking_status" class="form-control">
                                                <option value="pending" {{ $booking->booking_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $booking->booking_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="cancelled" {{ $booking->booking_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('bookings.destroy', $booking->booking_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Booking Modal -->
<button class="btn btn-success" data-toggle="modal" data-target="#addBookingModal">Add Booking</button>
<div class="modal fade" id="addBookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('bookings.adminstore') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Select User -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Room -->
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Room</label>
                        <select name="room_id" class="form-control" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->room_id }}">{{ $room->room_id }} - {{ $room->type }} ({{ number_format($room->prices, 2) }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Check-In Date -->
                    <div class="mb-3">
                        <label for="check_in_date" class="form-label">Check-In Date</label>
                        <input type="date" name="check_in_date" class="form-control" required>
                    </div>

                    <!-- Check-Out Date -->
                    <div class="mb-3">
                        <label for="check_out_date" class="form-label">Check-Out Date</label>
                        <input type="date" name="check_out_date" class="form-control" required>
                    </div>
                    <!-- Guest Count -->
                    <div class="mb-3">
                        <label for="guest_count" class="form-label">Guest Count</label>
                        <input type="number" name="guest_count" class="form-control" min="1" required>
                    </div>

                    <!-- Booking Status -->
                    <div class="mb-3">
                        <label for="booking_status" class="form-label">Booking Status</label>
                        <select name="booking_status" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
