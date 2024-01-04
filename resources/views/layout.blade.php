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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/grt-youtube-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @toastr_css
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    <style>
        [x-cloak] { display: none !important; }
        body{
            font-family: Roboto;
        }
    </style>
</head>

<body>
<div class="wrapper d-flex align-items-stretch">
    @include('menu')

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="flex w-full align-items-center">
                    <div class="w-1/2">
                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                    </div>
                    <div class="w-1/2">
                        <div class="text-right">
                            <button class="btn header-item waves-effect d-inline text-center">
                                <div class="flex justify-content-center">
                                    <img class="rounded-circle header-profile-user" src="{{Auth::user()->img}}" alt="Header Avatar">
                                </div>
                                <span class="d-none d-sm-inline-block ml-1">{{Auth::user()->name}}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/grt-youtube-popup.js')}}"></script>
<script src="{{asset('js/sidebar.js')}}"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@livewireScripts
<script src="{{ asset('vendor/pharaonic/pharaonic.select2.min.js') }}"></script>
@stack('scripts')
@if(isset($jsValidator))
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $jsValidator->selector('#js-form') !!}
@endif
</body>
@toastr_js
@toastr_render
</html>

