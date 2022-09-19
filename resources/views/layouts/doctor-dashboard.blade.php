<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('css/adminlte.min.css')}}">
        <link rel="shortcut icon" href="{{ asset('images/HOSAPP.png') }}" type="image/x-icon" />
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/toastr/toastr.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
{{--        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">--}}
        @stack('styles')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('pages.doctor.includes.header-nav')
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{ route('home') }}" class="brand-link">
                    <img src="{{ asset('images/HOSAPP.png') }}" alt="{{ config('app.name') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
                </a>
                @include('pages.doctor.includes.side-nav')
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">{{ $title }}</h1>
                            </div>
                            @include('pages.doctor.includes.breadcrumb')
                        </div>
                    </div>
                </div>
                <div class="content">
                    @yield('content')
                </div>
            </div>
            <aside class="control-sidebar control-sidebar-dark">
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    <span class="date-time"></span>
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>.</strong> All rights reserved.
            </footer>
        </div>
        <script src="{{ asset('bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
{{--        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>--}}
        <script src="{{ asset('bower_components/admin-lte/plugins/toastr/toastr.min.js') }}"></script>
{{--        <script src="{{ asset('js/common.js') }}"></script>--}}
        @include('pages.doctor.includes.toastr')
        @stack('scripts')
    </body>
</html>
