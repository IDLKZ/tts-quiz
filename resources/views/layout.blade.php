<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Личный кабинет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Корпоративнй портал" name="description" />
    <meta content="Корпоративный портал" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @toastr_css
    @stack('styles')
    <style>
        body{
            font-family: Roboto;
        }
    </style>
</head>

<body data-topbar="colored">

<!-- Begin page -->
<div id="layout-wrapper">
    @include('header')
    @include('menu')
    <!-- ============================================================== -->
    @yield('content')
</div>
<!-- END layout-wrapper -->
<!-- Laravel Javascript Validation -->

<script src="{{asset('js/script.js')}}"></script>
@stack('scripts')
@if(isset($jsValidator))
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $jsValidator->selector('#js-form') !!}
@endif
</body>
@toastr_js
@toastr_render
</html>

