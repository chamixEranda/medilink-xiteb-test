@extends('user.layouts.app')

@section('content')

<!-- about section -->
<section class="about_section layout_padding">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.jpg" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About <span>Us</span>
              </h2>
            </div>
            <p>
              MediLink is a revolutionary platform designed to streamline prescription management for 
              both patients and pharmacies. We believe everyone deserves a secure, convenient, and 
              efficient way to handle their medications.
            </p>
            <p class="font-weight-bold">
              Join the MediLink Community
            </p>
            <p>
              MediLink is committed to building a future where prescription management is effortless
              and secure. We invite you to join our growing community and experience the future of healthcare.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- end about section -->
    
@endsection