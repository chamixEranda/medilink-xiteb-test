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
                                        Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
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
