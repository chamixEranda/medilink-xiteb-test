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
<script type="text/javascript" src="<?php echo asset('js/image-uploader.min.js') ?>"></script>
<script>
"use strict";

$('.input-images-1').imageUploader({
    maxSize: 2 * 1024 * 1024,
    maxFiles: 5
});

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

function route_alert(route, message,title="{{translate('messages.are_you_sure')}}") {
    Swal.fire({
        title: title,
        text: message,
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: 'default',
        confirmButtonColor: '#FC6A57',
        cancelButtonText: '{{ translate('messages.no') }}',
        confirmButtonText: '{{ translate('messages.Yes') }}',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            if (message == 'Change status to processing  ') {
                $('#add-process-time').modal('show');
            }else{
                location.href = route;
            }
            
        }
    })
}

@if ($errors->any())
    var errorMessages = '';
    @foreach ($errors->all() as $error)
    ToastMixin.fire({
        animation: true,
        icon: 'warning',
        title: '{{ $error }}'
    });
    @endforeach
@endif

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

$(function()
{
    $('.digit-group').find('input').each(function() {
        $(this).attr('maxlength', 1);
        $(this).on('keyup', function(e)
        {
            var parent = $($(this).parent());
            if(e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find('input#' + $(this).data('previous'));

                if(prev.length) {
                    $(prev).select();
                }
            } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                var next = parent.find('input#' + $(this).data('next'));

                if(next.length) {
                    $(next).select();
                } else {
                    if(parent.data('autosubmit')) {
                        parent.submit();
                    }
                }
            }
        });
    });
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
        success: function(response) {
            $('.btn-preloader').hide();
            $('.email-verify-btn').attr('disabled', false);
            $('#verify_user_email').attr('readonly', true);
            $('#verify_email_btn').hide();

            $('input[name="email_verifying"]').val(email);

            ToastMixin.fire({
                animation: true,
                icon: 'success',
                title: response.message
            });
            $('#signup_otp_verify_section').show();
        },
        error: function(xhr, status, error) {
            $('.btn-preloader').hide();
            $('.email-verify-btn').attr('disabled', false);
            if (xhr.status == 400) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = "Validation Error:\n";
                for (var key in errors) {
                    errorMessage += "- " + errors[key].message + "\n";
                }
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: errorMessage
                });
            } else {
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: 'Somthing went wrong!'
                });
            }
        }
    })
}

function signup_otp_verify(){
    var formData = new FormData($('.signup_otp_verification_form')[0]);
    var digit1 = $('#digit-1').val();
    var digit2 = $('#digit-2').val();
    var digit3 = $('#digit-3').val();
    var digit4 = $('#digit-4').val();

    if (digit1 == '' || digit2 == '' || digit3 == '' || digit4 == '') {
        $('.btn-preloader-email').hide();
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: 'Please enter the OTP!'
        });
        return;
    } else{
        $('.btn-preloader-email').show();
    }

    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '{{ route('sign-up.verify-email-otp') }}',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#signup_otp_verify_section').hide();
            $('#after_verify_section').show();
            ToastMixin.fire({
                animation: true,
                icon: 'success',
                title: response.message
            });
        },
        error: function(xhr, status, error) {
            $('.btn-preloader-email').hide();
            if (xhr.status == 400) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = "Validation Error:\n";
                for (var key in errors) {
                    errorMessage += "- " + errors[key].message + "\n";
                }
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: errorMessage
                });
            } 
            else if(xhr.status == 401) {
                var errorMessage = xhr.responseJSON.message;
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: errorMessage
                });
            }
        }
    })
}

function registerWithEmail(){
    var formData = new FormData($('.form_email_register')[0]);
    var contact = formData.get("contact_no");
    var password = formData.get("password");
    var confirmPassword = formData.get("confirm_password");

    var phoneNumberPattern = /^0[0-9]{9}$/;
    if (phoneNumberPattern.test(contact)) {
        $('.btn-preloader-register').show();
    } else {
        $('.btn-preloader-register').hide();
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: 'Contact no should contain 10 digits'
        });
        return;
    }

    if (password.length < 8) {
        $('.btn-preloader-register').hide();
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: 'Password shoul have more than 8 characters'
        });
        return;
    }

    if (password != confirmPassword) {
        $('.btn-preloader-register').hide();
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: 'Confirm password shoul be same as password'
        });
        return;
    }

    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '{{ route('sign-up.store') }}',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(response) {
            $('.btn-preloader-register').hide();
            ToastMixin.fire({
                animation: true,
                icon: 'success',
                title: response.message
            });
            location.replace('{{ route('home') }}');
        },
        error: function(xhr, status, error) {
            $('.btn-preloader-register').hide();
            if (xhr.status == 400) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = "Validation Error:\n";
                for (var key in errors) {
                    errorMessage += "- " + errors[key].message + "\n";
                }
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: errorMessage
                });
            } 
            else if(xhr.status == 401) {
                var errorMessage = xhr.responseJSON.message;
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: errorMessage
                });
            }
        }
    })
}

$('#user_login_form').on('submit', function(e){
    e.preventDefault();
    $('.btn-preloader-login').show();
    var formData = new FormData($('#user_login_form')[0]);
    var email = formData.get("email");
    var password = formData.get("password");
    var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 

    if (email.length == 0) {
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: "Please enter your email!"
        });
        $('.btn-preloader-login').hide();
        return;
    }
    if (!email.match(pattern)) {
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: "Please enter valid email!"
        });
        $('.btn-preloader-login').hide();
        return;
    }

    if (password.length < 8) {
        $('.btn-preloader-login').hide();
        ToastMixin.fire({
            animation: true,
            icon: 'warning',
            title: 'Password shoul have more than 8 characters'
        });
        return;
    }

    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '{{ route('login.check') }}',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(response) {
            $('.btn-preloader-login').hide();
            ToastMixin.fire({
                animation: true,
                icon: 'success',
                title: response.message
            });
            location.replace('{{ route('home') }}');
        },
        error: function(xhr, status, error) {
            $('.btn-preloader-login').hide();
            if (xhr.status == 400) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = "Validation Error:\n";
                for (var key in errors) {
                    errorMessage += "- " + errors[key].message + "\n";
                }
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: errorMessage
                });
            } 
            else if(xhr.status == 401) {
                var errorMessage = xhr.responseJSON.message;
                ToastMixin.fire({
                    animation: true,
                    icon: 'warning',
                    title: errorMessage
                });
            }
        }
    })
});



</script>