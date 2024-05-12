@extends('user.layouts.app')

@section('content')
<style>
  .input-field {
      position: relative;
      margin-top: 2.2rem;
  }
  .input-field label.active {
      -webkit-transform: translateY(-15px) scale(0.8);
      transform: translateY(-15px) scale(0.8);
      -webkit-transform-origin: 0 0;
      transform-origin: 0 0;
  }
</style>
<!-- prescription section -->
<section class="layout_margin-top layout_margin-bottom contact_section" id="quotation_Section">
  <div class="container">
    <div class="card border-light-subtle shadow-sm">
      <div class="card-header">
        <h2 class="card-title">{{ translate('messages.request_a_quotation') }}</h2>
      </div>
      <div class="card-body">
        <div class="col-lg-12 form_container">
          <div class="row">
            <div class="col-lg-6">
              <div class="input-field">
                <label class="active">Photos</label>
                <div class="input-images-1" style="padding-top: .5rem;"></div>
            </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group row my-2">
                <label for="deliveryAddress" class="col-sm-4 col-form-label">Delivery Address</label>
                <div class="col-sm-8">
                  <textarea name="delivery_address" class="form-control" id="deliveryAddress" cols="50" rows="5"></textarea>
                </div>
              </div>
              <div class="form-group row my-2">
                <label for="deliverynote" class="col-sm-4 col-form-label">Note</label>
                <div class="col-sm-8">
                  <textarea name="delivery_note" class="form-control" id="deliverynote" cols="50" rows="5"></textarea>
                </div>
              </div>
              <div class="form-group row my-2">
                <label for="deliveryTime" class="col-sm-4 col-form-label">Delivery Time</label>
                <div class="col-sm-8">
                  <select id="deliveryTime" class="form-control">
                    @foreach ($timeSlots as $time)
                      <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end prescription section -->

<!-- about section -->
<section class="about_section layout_margin-bottom" id="about_us_Section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="{{ asset('images/aboutus.jpeg') }}" alt="About us">
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

<!-- contact section -->
<section class="contact_section layout_padding" id="contactus_Section">
  <div class="container">
    <div class="heading_container">
      <h2>
        Get In Touch
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form_container contact-form">
          <form action="">
            <div class="form-row">
              <div class="col-lg-6">
                <div>
                  <input type="text" placeholder="Your Name" />
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <input type="text" placeholder="Phone Number" />
                </div>
              </div>
            </div>
            <div>
              <input type="email" placeholder="Email" />
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message" />
            </div>
            <div class="btn_box">
              <button>
                SEND
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="map_container">
          <div class="map">
            <div id="googleMap">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.095494572193!2d79.85798821491655!3d6.8791620208345785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25bc708daaaab%3A0x2f0766d0936e9084!2s7%20Colombo%20-%20Galle%20Main%20Rd%2C%20Colombo%2000600!5e0!3m2!1sen!2slk!4v1673423245928!5m2!1sen!2slk"
                frameborder="0" style="border:0;width:100%;height:100%" allowfullscreen="true" aria-hidden="false" tabindex="0">
              </iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end contact section -->

@endsection
