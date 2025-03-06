<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'jksolutions') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <!-- bootstrap css -->

    <!-- style css -->

    <!-- favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/gif" />

    <!-- CSS -->

    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

    <!-- notification for small viewports and landscape oriented smartphones -->
    <div class="device-notification">
        <a class="device-notification--logo" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Global">
            <p>{{ config('app.name', 'jksolutions') }}</p>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
    </div>

    <div class="perspective effect-rotate-left">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="{{ asset('userset/js/vendor/jquery-2') }}.2.4.min.js"><\/script>')
    </script>
    <script src="{{ asset('userset/js/functions-min.js') }}"></script>
</body>

</html>
