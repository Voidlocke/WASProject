<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/raty/2.7.1/jquery.raty.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
  <body>
    <!--Top BE-->

    <div class="top_bar">
        <div class="container">
            <div class="row w-100"> <!-- Full width for the row -->
                <div class="col d-flex justify-content-between align-items-center">
                    <!-- Social Media Links on the Left -->
                    <div class="social">
                        <ul class="social_list">
                            <li class="social_list_item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                    <!-- User Box (Login/Register) on the Right -->
                    <div class="user_box d-flex ml-auto"> <!-- Ensure user_box is treated as flex and aligned to the right -->
                        @if (Auth::check())
                        <div class="user_box_profile user_box_link">
                            <a href="{{ route('profile.show') }}">Profile</a>
                        </div>
                        <div class="spacer"></div>
                        <div class="user_box_link">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </div>

                        <!-- Hidden Form for Logout -->
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>

                        @else
                            <div class="user_box_login user_box_link"><a href="{{ route('login') }}">Sign In</a></div>
                            <div class="user_box_register user_box_link"><a href="{{ route('register') }}">Register</a></div>
                        @endif
                        <div class="user_box_link">
                            <a href="/rooms" class="btn btn-primary book-now-btn">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="position: fixed; top: 10; left: 0; right: 0; z-index: 9999; margin-top: 0; padding-top: 15px; padding-bottom: 15px;">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" alt="Moonlit Lagoon Logo" style="height: 30px; margin-right: 10px;">
            <a class="navbar-brand" href="/">Moonlit Lagoon
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <!-- Home link with active class -->
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a href="/" class="nav-link">Home</a>
                    </li>

                    <!-- Rooms link with active class -->
                    <li class="nav-item {{ Request::is('rooms') ? 'active' : '' }}">
                        <a href="/rooms" class="nav-link">Rooms</a>
                    </li>

                    <!-- Reviews link with active class -->
                    <li class="nav-item {{ Request::is('reviews') ? 'active' : '' }}">
                        <a href="/reviews" class="nav-link">Reviews</a>
                    </li>

                    <!-- Contact link with active class -->
                    <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                        <a href="/contact" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
	  </nav>
    <!-- END nav -->

    @yield('content')

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Moonlit Lagoon Hotel</h2>
              <p>Far far away, behind the word mountains, far from the cities.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Useful Links</h2>
              <ul class="list-unstyled">
                <li><a href="/reviews" class="py-2 d-block">Reviews</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Privacy</h2>
              <ul class="list-unstyled">
                <li><a href="/contact" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Moonlit Lagoon Hotel, 123 Jalan Lagoon Utama, Sunway City, 47500 Subang Jaya, Selangor, Malaysia.</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+60 17 3523 5598</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">moonlitlagoonhotel.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raty/2.7.1/jquery.raty.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
  <script src="{{ asset('js/scrollax.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- Initialize jQuery Raty -->
  <script>
      $(document).ready(function() {
          $('#rating').raty({
              half: true,
              starType: 'i', // Use <i> tags for stars
              starOn: 'fa fa-star',
              starHalf: 'fa fa-star-half-o',
              starOff: 'fa fa-star-o',
              click: function(score, evt) {
                  $('#rating-score').val(score);
              }
          });
      });
  </script>
  </body>
</html>
