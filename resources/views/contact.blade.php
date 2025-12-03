@extends('master.layout')
@section('content')

    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
              <div class="text">
                <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact</span></p>
                <h1 class="mb-4 bread">Contact Us</h1>
            </div>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section contact-section bg-light">
    <h3 class="ourlocation">Our Location</h3>
      <div class="container">
        <div class="row block-9">
          <div class="col-md-12 d-flex mb-5">
            <iframe
            width="100%"
            height="400"
            frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.0606825994123!2d-72.8735845851828!3d40.760690042573295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e85b24c9274c91%3A0xf310d41b791bcb71!2sWilliam%20Floyd%20Pkwy%2C%20Mastic%20Beach%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1578582744646!5m2!1sen!2sbd" allowfullscreen>
        </iframe>

          </div>
        </div>
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h3">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-6 d-flex">
              <div class="info bg-white p-4">
                <p class="contactdesc">We’re here to help! Whether you have questions or want to share feedback, we’d love to hear from you.
                    <br> Reach out to our friendly team via phone, email or the contact form. Your satisfaction is our priority, and we’re committed to providing you with the best service possible.
                    <br> Don’t hesitate – we’re just a message away!</p>
                <br>
                <p><span>ADDRESS </br></span> <a href="#">Moonlit Lagoon Hotel, 123 Jalan Lagoon Utama, Sunway City, 47500 Subang Jaya, Selangor, Malaysia </a></p>
                <p><span>CONTACT NUMBER  </br></span> <a href="tel://1234567920">+60 17 3523 5598</a></p>
                <p><span>EMAIL  </br></span> <a href="mailto:info@yoursite.com">moonlitlagoon@gmail.com</a></p>
                <p><span>WEBSITE  </br></span> <a href="#">moonlitlagoonhotel.com</a></p>
              </div>
          </div>
          <div class="col-md-6 d-flex">
            <form action="#" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection
