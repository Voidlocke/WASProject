@extends('master.layout')
@section('content')

    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Rooms</span></p>
	            <h1 class="mb-4 bread">Rooms</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    @php
    $roomImages = [
        'Suite Room' => '/images/room-1.jpg',
        'Family Room' => '/images/room-2.jpg',
        'Deluxe Room' => '/images/room-3.jpg',
        'Classic Room' => '/images/room-4.jpg',
        'Superior Room' => '/images/room-5.jpg',
        'Luxury Room' => '/images/room-6.jpg',
    ];
    @endphp

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @if ($rooms->isEmpty())
                        <!-- Center the message -->
                        <div class="col-12 text-center">
                            <p class="mt-5 mb-5" style="font-size: 1.5rem; color: #333;">
                                No rooms found for the given criteria.
                            </p>
                        </div>
                        @endif
                        @foreach ($rooms as $room)
                            <div class="col-sm col-md-6 col-lg-4 ftco-animate">
                                <div class="room">
                                    <a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url('{{ $roomImages[$room->type] ?? '/images/default.jpg' }}');"></a>
                                    <div class="text p-3 text-center">
                                        <h3 class="mb-3"><a href="rooms-single.html">{{ $room->type }}</a></h3>
                                        <p><span class="price mr-2">RM{{ number_format($room->prices, 2) }}</span> <span class="per">per night</span></p>
                                        <ul class="list">
                                            <li><span>Max Persons:</span> {{ $room->maxperson }}</li>
                                            <li><span>Size:</span> 45 m2</li>
                                            <li><span>Bed:</span> {{ $room->bed }}</li>
                                            <li><span>View:</span> Sea View</li>
                                            <li><span>Availability:</span> {{ $room->availability ? 'Available' : 'Unavailable' }}</li>

                                        </ul>
                                        <hr>
                                        <!--<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p> -->
                                        <form action="{{ route('bookings.store') }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                            <input type="hidden" name="room_type" value="{{ $room->type }}">
                                            <input type="hidden" name="check_in_date" value="{{ session('checkin_date') }}">
                                            <input type="hidden" name="check_out_date" value="{{ session('checkout_date') }}">
                                            <input type="hidden" name="price" value="{{ $room->prices }}">
                                            <input type="hidden" name="guest_count" value="{{ session('cus_count') }}">
                                            <button type="submit" class="btn btn-primary">Book Now</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
    <!--<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
	        <div class="col-lg-9">
		    		<div class="row">
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-1.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Suite Room</a></h3>
		    						<p><span class="price mr-2">RM120.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 3 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 1</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-2.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Family Room</a></h3>
		    						<p><span class="price mr-2">RM20.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 3 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 1</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-3.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Deluxe Room</a></h3>
		    						<p><span class="price mr-2">RM150.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 5 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 2</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-4.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Classic Room</a></h3>
		    						<p><span class="price mr-2">RM130.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 5 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 2</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-5.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Superior Room</a></h3>
		    						<p><span class="price mr-2">RM300.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 6 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 3</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="col-sm col-md-6 col-lg-4 ftco-animate">
		    				<div class="room">
		    					<a href="rooms-single.html" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-6.jpg);">
		    						<div class="icon d-flex justify-content-center align-items-center">
		    							<span class="icon-search2"></span>
		    						</div>
		    					</a>
		    					<div class="text p-3 text-center">
		    						<h3 class="mb-3"><a href="rooms-single.html">Luxury Room</a></h3>
		    						<p><span class="price mr-2">RM500.00</span> <span class="per">per night</span></p>
		    						<ul class="list">
		    							<li><span>Max:</span> 5 Persons</li>
		    							<li><span>Size:</span> 45 m2</li>
		    							<li><span>View:</span> Sea View</li>
		    							<li><span>Bed:</span> 2</li>
		    						</ul>
		    						<hr>
		    						<p class="pt-1"><a href="room-single.html" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
		    					</div>
		    				</div>
		    			</div>
		    		</div>
		    	</div> -->
		    	<div class="col-lg-3 sidebar">
	      		<div class="sidebar-wrap bg-light ftco-animate">
	      			<h3 class="heading mb-4">Advanced Search</h3>
	      			<form action="{{ route('rooms') }}" method="GET">
	      				<div class="fields">
		              <div class="form-group">
		                <input type="text" name="checkin_date" id="checkin_date" class="form-control checkin_date" placeholder="Check In Date">
		              </div>
		              <div class="form-group">
		                <input type="text" name="checkout_date" id="checkin_date" class="form-control checkout_date" placeholder="Check Out Date">
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
	                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                    <select name="room_type" id="room_type" class="form-control" >
                            <option value="">Room Type</option>
                            <option value="Suite Room">Suite Room</option>
                            <option value="Family Room">Family Room</option>
                            <option value="Deluxe Room">Deluxe Room</option>
                            <option value="Classic Room">Classic Room</option>
                            <option value="Superior Room">Superior Room</option>
                            <option value="Luxury Room">Luxury Room</option>
                        </select>
	                  </div>
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
	                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                    <select name="guest_count" id="guest_count" class="form-control" >
                            <option value="">Guests</option>
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5 Guests</option>
                            <option value="6">6 Guests</option>
	                    </select>
	                  </div>
		              </div>

		                <input type="submit" value="Apply" class="btn btn-primary py-3 px-5">
		              </div>
		            </div>
	            </form>
	      		</div>

	        </div>
		    </div>
    	</div>
    </section>



    <section class="instagram pt-5">
      <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2><span>Instagram</span></h2>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-1.jpg" class="insta-img image-popup" style="background-image: url(images/insta-1.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-2.jpg" class="insta-img image-popup" style="background-image: url(images/insta-2.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-3.jpg" class="insta-img image-popup" style="background-image: url(images/insta-3.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-4.jpg" class="insta-img image-popup" style="background-image: url(images/insta-4.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-5.jpg" class="insta-img image-popup" style="background-image: url(images/insta-5.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>


    @endsection


<!-- <form action="{{ route('rooms') }}" method="GET">
	      				<div class="fields">
		              <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control checkin_date" placeholder="Check In Date">
		              </div>
		              <div class="form-group">
		                <input type="text" id="checkin_date" class="form-control checkout_date" placeholder="Check Out Date">
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
	                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                    <select name="room_type" id="room_type" class="form-control" >
                            <option value="">Room Type</option>
                            <option value="Suite Room">Suite Room</option>
                            <option value="Family Room">Family Room</option>
                            <option value="Deluxe Room">Deluxe Room</option>
                            <option value="Classic Room">Classic Room</option>
                            <option value="Superior Room">Superior Room</option>
                            <option value="Luxury Room">Luxury Room</option>
                        </select>
	                  </div>
		              </div>
		              <div class="form-group">
		                <div class="select-wrap one-third">
	                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                    <select name="guest_count" id="guest_count" class="form-control" >
                            <option value="">Guests</option>
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5 Guests</option>
                            <option value="6">6 Guests</option>
	                    </select>
	                  </div>
		              </div>

		                <input type="submit" value="Apply" class="btn btn-primary py-3 px-5">
		              </div>
		            </div>
	            </form> -->
