<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <link rel="shortcut icon" href="{{ asset('images/HOSAPP.png') }}" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/toastr/toastr.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        @yield('styles')

    </head>
    <body class="hold-transition login-page">
        @yield('content')

        <script src="{{ asset('bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-lte/plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('js/common.js') }}"></script>
        @include('pages.admin.includes.toastr')
        @yield('scripts')
    </body>
</html>
