<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $website_settings->title }} - @yield('title')</title>
    <meta property="og:title" content="{{ $website_settings->title }} - @yield('title')">
    <meta name="twitter:title" content="{{ $website_settings->title }} - @yield('title')">
    <meta property="og:site_name" content="{{ $website_settings->title }}">

    <meta name="description" content="@yield('description', $website_settings->description)">
    <meta property="og:description" content="@yield('description', $website_settings->description)">
    <meta name="twitter:description" content="@yield('description', $website_settings->description)">

    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="keywords" content="{{ $website_settings->keywords }}">

    <meta name="twitter:image" content="@yield('display_image', $website_settings->display_cover)">
    <meta property="og:image" content="@yield('display_image', $website_settings->display_cover)">
    <meta name="twitter:card" content="@yield('display_image', $website_settings->display_cover)">

    <link rel="shortcut icon" href="{{ $website_settings->favicon }}" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="{{ $website_settings->favicon }}">
    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('front/libs/bootstrap/css/bootstrap' . (LaravelLocalization::getCurrentLocale() == 'ar' ? '.rtl' : '') . '.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/libs/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/libs/sweetalert2/sweet.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    @include('front.partials._nav')

    @yield('content')

    @include('front.partials._footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front/libs/sweetalert2/sweet.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script src="{{ asset('front/js/main-module.js') }}" type="module"></script>
</body>
</html>