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

<script src="{{asset('js/script.js')}}"></script>
</body>
</html>

