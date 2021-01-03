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

@yield("content")

<!-- JAVASCRIPT -->
<script src="{{asset('js/login.js')}}"></script>


<!-- Laravel Javascript Validation -->
@if(isset($jsValidator))
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $jsValidator->selector('#js-form') !!}
@endif
</body>

</html>
