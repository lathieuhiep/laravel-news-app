<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- fontawesome 6.2.1 -->
    <link href="{{ asset('assets/libs/fontawesome/css/all.min.css') }}" rel="stylesheet">

    <!-- Style CSS + Bootstrap -->
    <link href="{{ asset('admin/assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/custom.css') }}" rel="stylesheet">

    <title>@yield('title') - News App</title>
</head>
<body class="sb-nav-fixed">
    @include('admin.layouts.header')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <div class="container-fluid pt-4 px-4 pb-4">
                @yield('content')
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
</body>
</html>