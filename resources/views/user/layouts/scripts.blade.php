@yield('js')
<!-- jQery -->
<script type="text/javascript" src="<?php echo asset('js/jquery-3.4.1.min.js') ?>"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<!-- bootstrap js -->
<script type="text/javascript" src="<?php echo asset('js/bootstrap.js') ?>"></script>
<!-- owl slider -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- custom js -->
<script type="text/javascript" src="<?php echo asset('js/custom.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('js/sweetalert2@11.js') ?>"></script>
<script>
"use strict";

var ToastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: '',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();


$(".client_owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    dots: false,
    nav: true,
    navText: [],
    autoplay: true,
    autoplayHoverPause: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 2
        }
    }
});

function verifyEmail(){
    $('.btn-preloader').show();
    $('.email-verify-btn').attr('disabled', true);
    var formData = new FormData($('.form_email_register')[0]);
    var email = formData.get("email");
    var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 

    if (email.length == 0) {
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: "Please enter your email!"
        });
        $('.btn-preloader').hide();
        $('.email-verify-btn').attr('disabled', false);
        return;
    }
    if (!email.match(pattern)) {
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: "Please enter valid email!"
        });
        $('.btn-preloader').hide();
        $('.email-verify-btn').attr('disabled', false);
        return;
    }
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '{{ route('sign-up.verify-email') }}',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {

        }
    })
}
</script>