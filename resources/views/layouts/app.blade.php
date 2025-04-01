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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <div class="container" x-data="{ rightSide: false, leftSide: false }">
        @section('leftSide')
            @include('layouts.leftSide')
        @show

        @yield('content')

        @auth
            @section('rightSide')
                @include('layouts.rightSide')
            @show
        @endauth

    </div>


</body>

</html>
<!-- @section('nav')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection
@section('sidebar')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection -->