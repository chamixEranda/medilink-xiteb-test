@extends('user.layouts.app')

@section('content')
<section class="p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="card border-light-subtle shadow-sm">
            <div class="row g-0">
                <div class="col-12 col-md-6 text-bg-primary">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <img class="img-fluid rounded h-100" style="object-fit: cover;" loading="lazy" src="{{asset('images/signup.jpg')}}" alt="Sign Up">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-body p-2 p-md-3 p-xl-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h3>Sign Up</h3>
                                </div>
                            </div>
                        </div>
                        <div class="signup-form-section">
                            <form class="form_email_register" autocomplete="off" method="POST">
                                @csrf
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12 my-2">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="verify_user_email" required>
                                        {{-- <span class="invalid-div text-danger text-xs w-full font-weight-bold"></span> --}}
                                    </div>
                                    <div class="col-12" id="verify_email_btn">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl email-verify-btn" onclick="verifyEmail()" type="button">
                                                <img class="btn-preloader" src="{{ asset('images/preloader.gif') }}" style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:none">{{ translate('messages.verify_email') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div id="after_verify_section" style="display: none">
                                        <div class="col-12 my-2">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        <div class="col-12 my-2">
                                            <label for="contact" class="form-label">Contact No. <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="contact_no" id="contact_no" required>
                                        </div>
                                        <div class="col-12 my-2">
                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="col-12 my-2">
                                            <label for="password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                        </div>
                                        <div class="col-12 my-2">
                                            <label for="dob" class="form-label">DOB <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="dob" id="dob" required>
                                        </div>
                                        <div class="col-12 my-2">
                                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label> <br>
                                            <textarea name="address" class="form-control" id="address" cols="50" rows="5" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn bsb-btn-xl" type="button" onclick="registerWithEmail()">
                                                    <img class="btn-preloader-register" src="{{ asset('images/preloader.gif') }}" style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:none">{{ translate('messages.sign_up_now') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                            <div id="signup_otp_verify_section" style="display: none">
                                <div>
                                    <div class="flex justify-between">
                                        <h4 class="font-semibold">{{ translate('messages.verify_otp') }}</h4>
                                    </div>
                                </div>
                                <form class="signup_otp_verification_form text-center" method="post" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="email_verifying" value="">
                                    <div class="digit-group space-evenly" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                        <input type="text" required id="digit-1" name="digit_1" data-next="digit-2"  class="verfication-input" />
                                        <input type="text" required id="digit-2" name="digit_2" data-next="digit-3" data-previous="digit-1" class="verfication-input" />
                                        <input type="text" required id="digit-3" name="digit_3" data-next="digit-4" data-previous="digit-2" class="verfication-input" />
                                        <input type="text" required id="digit-4" name="digit_4" data-next="digit-5" data-previous="digit-3"  class="verfication-input" />
                                    </div>
                                    <div class="text-center mt-2 mb-3">
                                        <button class="btn bsb-btn-xl regiter-continue-btn" onclick="signup_otp_verify()" type="button">
                                            <img class="btn-preloader-email" src="{{ asset('images/preloader.gif') }}" style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:none">{{ translate('messages.continue') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="row d-flex justify-content-center mt-4">
                                <p>{{ translate('messages.already_have_an_account') }}? <a href="{{ route('login') }}" class="text-success">Log in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection