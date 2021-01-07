<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Вход в личный кабинет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Вход в личный кабинет корпортаивного портала" name="description" />
    <meta content="Корпоративный портал" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    @toastr_css
</head>

<body class="bg-primary bg-pattern">
<nav class="navbar navbar-expand-md navbar-dark bg-transparent">
    <div class="order-0">
        <img src="/images/logo.png" height="55px" width="75px" src="">

    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item bg-success border border-light mx-1">
                <a class="nav-link text-white" href="#">Temirtransservice@mail.ru</a>
            </li>
            <li class="nav-item bg-success border border-light mx-1">
                <a class="nav-link text-white" href="#">г. Нур-Султан ул. Кунаева 10, 26этаж</a>
            </li>
            <li class="nav-item bg-success border border-light mx-1">
                <a class="nav-link text-white" href="tel:+77172610626">+7-7172-610-626</a>
            </li>
        </ul>
    </div>
</nav>


@yield("content")

<!-- JAVASCRIPT -->
<script src="{{asset('js/login.js')}}"></script>


<!-- Laravel Javascript Validation -->
@if(isset($jsValidator))
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $jsValidator->selector('#js-form') !!}
@endif
</body>
@toastr_js
@toastr_render
</html>
