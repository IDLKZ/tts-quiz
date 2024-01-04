@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
        <div class="container mb-5">
            <div class="row">
                <div class="col-12 col-md-6 my-2">
                    <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                        Мероприятия
                    </p>
                    <p class="text-md font-bold lg:text-lg">
                        {{$event->title}}
                    </p>
                </div>
                <div class="col-12 col-md-6 my-2 text-right">
                    <a href="{{route("event-all")}}" class="btn btn-warning text-white px-4 py-2">
                       Назад в События
                    </a>
                </div>
            </div>
        </div>
            <div class="container">
                <div class="row mt-5">

                    <div class="col-span-12">
                        <section class="bg-white dark:bg-gray-900 rounded-lg">
                            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                                <div class="order-2 lg:order-1 mr-auto place-self-center lg:col-span-7">
                                    <h1 class="max-w-2xl text-md md:text-lg lg:text-xl xl:text-2xl 2xl:text-4xl mb-4 text-4xl font-extrabold tracking-tight leading-none">
                                        {{$event->title}}
                                    </h1>
                                    <div class="flex font-bold text-gray-500 my-3 align-items-center">
                                        <i class="fas fa-clock mr-2 text-success"></i> Дата проведения
                                            {{$event->start_date->format("H:i d/m/Y")}}
                                            @if ($event->end_date)
                                                 - {{$event->end_date->format("H:i d/m/Y")}}
                                            @endif

                                    </div>
                                    <div class="flex font-bold text-gray-500 my-3 align-items-center">
                                        <i class="fas fa-map-marker-alt mr-2 text-success"></i> Адрес проведения
                                            {{$event->address}}
                                    </div>
                                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-sm lg:text-md dark:text-gray-400">
                                        {!! $event->description !!}
                                    </p>
                                </div>
                                <div class="order-1 lg:order-2 lg:mt-0 lg:col-span-5 lg:flex my-2">
                                    <img src="{{$event->getFile("image_url")}}" alt="mockup">
                                </div>
                            </div>
                        </section>
                    </div>

                </div>
                <!-- end row -->

            </div>
        <!-- End Page-content -->
        </div>
    </div>
    <!-- end main content-->

@endsection
