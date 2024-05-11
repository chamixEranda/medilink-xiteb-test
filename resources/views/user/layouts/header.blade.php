@if (Route::is('home'))
<div class="hero_area">
    <div class="hero_bg_box">
        <img src="<?php echo asset('images/hero-bg.png') ?>" alt="">
    </div>

    @include('user.layouts.navbar')

    <!-- slider section -->
    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="detail-box">
                                    <h1>
                                        We Provide Best Healthcare
                                    </h1>
                                    <p>
                                        Take control of your healthcare. Streamline your prescription management with secure, convenient access from anywhere.
                                    </p>
                                    <div class="btn-box">
                                        <a href="" class="btn1 w-50">
                                            Request Quotation
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end slider section -->
</div>
@else
<div class="hero_area">
    @include('user.layouts.navbar')
</div>
@endif
