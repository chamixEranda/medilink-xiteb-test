<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{translate('messages.pharmacy')}} | {{translate('messages.login')}}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('imgages/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/css/theme.minc619.css?v=1.0')}}">
  <link rel="stylesheet" href="{{asset('assets/css/vendor.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="{{ route('pharmacy.auth.login') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('images/favicon.png') }}" width="100" alt="">
                </a>
                <h3 class="text-center">{{ env('APP_NAME', 'MediLink') }}</h3>
                <form action="{{route('pharmacy.auth.submit')}}" method="post" id="form-id">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{ translate('messages.email') }}</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>

                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">{{ translate('messages.password') }}</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 text-uppercase">{{ translate('messages.sign_in') }}</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{asset('assets/js/vendor.min.js')}}"></script>
  <script src="{{asset('assets/js/theme.min.js')}}"></script>
  <script src="{{asset('assets/js/toastr.js')}}"></script>
  {!! Toastr::message() !!}
  @if ($errors->any())
    <script>
      @foreach($errors->all() as $error)
      toastr.error('{{$error}}', Error, {
        CloseButton: true,
        ProgressBar: true
      });
      @endforeach
    </script>
@endif
</body>
</html>