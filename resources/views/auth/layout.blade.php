<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Вход в личный кабинет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Вход в личный кабинет корпортаивного портала" name="description" />
    <meta content="Корпоративный портал" name="author" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- App favicon -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <style>
        body{
            font-family: Roboto;
        }
    </style>
    @toastr_css
</head>

<body>


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
