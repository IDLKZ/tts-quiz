<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Личный кабинет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Корпоративнй портал" name="description" />
    <meta content="Корпоративный портал" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @toastr_css
    @stack('styles')
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

