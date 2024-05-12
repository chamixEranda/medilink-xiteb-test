@extends('user.layouts.app')

@section('content')
<section class="p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="card border-light-subtle shadow-sm">
            <div class="row g-0">
                <div class="col-12 col-md-6 text-bg-primary">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <img class="img-fluid rounded h-100" loading="lazy" src="{{asset('images/login.svg')}}" alt="Sign Up">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-body p-2 p-md-3 p-xl-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h3>{{ translate('messages.login') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="signup-form-section">
                            <form id="user_login_form" method="POST" autocomplete="off">
                                @csrf
                                <div class="row gy-3 gy-md-4 overflow-hidden mt-4">
                                    <div class="col-12 my-2">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="col-12 my-2">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl" type="submit">
                                                <img class="btn-preloader-login" src="{{ asset('images/preloader.gif') }}" style="width: 25px;height:25px;margin-left:auto;margin-right:auto;display:none">{{ translate('messages.login') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center mt-5">
                                    <p>New to MediLink? <a href="{{ route('sign-up') }}" class="text-success">{{ translate('messages.sign_up_here') }}</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection