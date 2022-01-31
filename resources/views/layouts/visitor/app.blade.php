<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <title> @yield('title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '') </title>
    <meta name="description" content="@yield('meta.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')">
    <meta name="keywords" content="@yield('meta.keywords', Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : '')">
    <meta name="author" content="{{ Arr::exists($shared_settings, 'author') ? $shared_settings['author'] : '' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og.title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '')">
    <meta property="og:description" content="@yield('og.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')">
    <meta property="og:image" content="{{ asset('assets/images/favicons/apple-touch-icon.png') }}">
    <meta property="og:site_name" content="{{ Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '' }}">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#ffffff">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#766df4">

    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#766df4">
    <meta name="apple-mobile-web-app-capable" content="yes"/>

    <!--App manifest-->
    <link rel="manifest" href="{{ asset('assets/images/favicons/site.webmanifest') }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicons/apple-touch-icon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="{{ asset('assets/images/favicons/favicon-16x16.png') }}" type="image/png">
    <link rel="icon" sizes="32x32" href="{{ asset('assets/images/favicons/favicon-32x32.png') }}" type="image/png">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/firasans.css') }}">

    <!-- Plugin styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/cookieconsent/build/cookieconsent.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert/sweetalert.min.css') }}">

    @stack('css')

    <!-- Theme styles -->
    <link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset('assets/visitor/css/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/visitor/css/custom.css') }}">

    @stack('head.js')

</head>

<body>

<div id="preloader">
    <img src="{{ asset('assets/images/preloaders/analyse.gif') }}" alt="">
</div>

@include('layouts.visitor.partials.header')

<main>

    @yield('content')

</main>

@include('layouts.visitor.partials.footer')

<!-- Back to top -->
<div class="back-top">
    <i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
</div>

<!-- Base JS -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugins JS -->
<script src="{{ asset('assets/vendor/smoothscroll-for-websites/smooth-scroll.polyfills.min.js') }}"></script>
<script src="{{ asset('assets/vendor/cookieconsent/build/cookieconsent.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

@stack('plugin.js')

<!-- End Plugins JS -->

<!-- Layout JS -->
<script src="{{ asset('assets/visitor/js/theme.js') }}"></script>
<script src="{{ asset('assets/visitor/js/layout.js') }}"></script>
<script>
    CookieQuestion(
        "{{ __('This website stores cookies on your computer. To find out more about the cookies we use, see our ') }}",
        "{{ __('OK') }}",
        "{{ __('Privacy Policy') }}",
        "{{ route('privacy') }}"
    );
</script>

<!-- Page Level JS -->

@include('plugins.session_sweetalert')

@stack('page.js')

</body>

</html>
