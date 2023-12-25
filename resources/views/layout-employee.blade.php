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
    <link rel="stylesheet" href="{{asset('css/grt-youtube-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/employee-style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @toastr_css
    @livewireStyles
    @stack('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Podkova:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body{
            background: #EDEBEB!important;
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body data-topbar="colored">
@include("employee-navbar")




<!-- Begin page -->
<div id="layout-wrapper">
    <!-- ============================================================== -->
    <div class="container mx-auto">
        @yield('content')
    </div>

</div>
<section class="bg-[#1D1D1D] py-10">
    <div class="container">
        <div class="grid grid-cols-12">
            <div class="col-span-12 md:col-span-6">
                <div class="md:flex align-items-center mx-auto text-center md:text-left">
                    <img src="{{asset("/images/footer-logo.png")}}" class="max-w-[100px] px-2 d-inline-block"/>
                    <div>
                        <p class="text-lg lg:text-lg xl:text-2xl 2xl:text-3xl text-white font-weight-bold">
                            Темир Транс Сервис
                        </p>
                        <div class="md:flex my-3">
                            <div class="text-white text-center md:text-left mr-2">
                                <i class="fas fa-envelope ml-2 text-[#F09E32]"></i>
                                tts@gmail.com
                            </div>
                            <div class="text-white mr-2 text-center md:text-left">
                                <i class="fab fa-instagram ml-2 text-[#F09E32]"></i>
                                tts.kazakhstan
                            </div>
                            <div class="text-white mr-2 text-center md:text-left">
                                <i class="fab fa-linkedin ml-2 text-[#F09E32]"></i>
                                TTS.KAZ
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-span-12">
                <p class="text-md text-white font-weight-bold text-center text-md-right">
                    Cookie Preferences <br/>
                    © 2023 tts kazakhstan. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- END layout-wrapper -->
<!-- Laravel Javascript Validation -->

<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/grt-youtube-popup.js')}}"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.3.9/jquery.mb.YTPlayer.min.js" integrity="sha512-rVFx7vXgVV8cmgG7RsZNQ68CNBZ7GL3xTYl6GAVgl3iQiSwtuDjTeE1GESgPSCwkEn/ijFJyslZ1uzbN3smwYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
@stack('scripts')
@livewireScripts
@if(isset($jsValidator))
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $jsValidator->selector('#js-form') !!}
@endif
</body>
@toastr_js
@toastr_render
</html>
