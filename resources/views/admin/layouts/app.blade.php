<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="icon" href="favicon.ico">

    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>

    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">

    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/feather.css') }}">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css') }}" id="darkTheme">

</head>

<body class="vertical  dark  ">
    <div class="wrapper">
        @section('nav')
            @include('admin.layouts.nav')
        @show
        @section('sidebar')
            @include('admin.layouts.sidebar')
        @show
        <main role="main" class="main-content">
            @yield('content')
        </main>
    </div>
    
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
    <script src='{{ asset("admin/js/daterangepicker.js") }}'></script>
    <script src='{{ asset("admin/js/jquery.stickOnScroll.js") }}'></script>
    <script src="{{ asset('admin/js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <script src="{{ asset('admin/js/d3.min.js') }}"></script>
    <script src="{{ asset('admin/js/topojson.min.js') }}"></script>
    <script src="{{ asset('admin/js/datamaps.all.min.js') }}"></script>
    <script src="{{ asset('admin/js/datamaps-zoomto.js') }}"></script>
    <script src="{{ asset('admin/js/datamaps.custom.js') }}"></script>
    <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
    <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="{{ asset('admin/js/gauge.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/js/apexcharts.custom.js') }}"></script>
    <script src="{{ asset('admin/js/apps.js') }}"></script>
</body>

</html>
