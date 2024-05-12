<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME','MediLink') }}</title>
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png">
    <!-- bootstrap core css -->
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.css') ?>" type="text/css">
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- font awesome style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Custom styles for this template -->
    <link href="<?php echo asset('css/style.css') ?>" rel="stylesheet" />
    <!-- responsive style -->
    <link href="<?php echo asset('css/responsive.css')?>" rel="stylesheet" />
    <link href="<?php echo asset('css/image-uploader.min.css')?>" rel="stylesheet" />
</head>
<body class="{{ !Route::is('home') ? 'sub_page' : '' }}">
    @include('user.layouts.header')
    @yield('content')
    @include('user.layouts.footer')
    @include('user.layouts.scripts')    
</body>
</html>