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
                        Опросник
                    </p>
                    <p class="text-md font-bold lg:text-lg">
                        {{$questionnaire->title}}
                    </p>
                </div>
                <div class="col-12 col-md-6 my-2 text-right">
                    <a href="{{route("list-questionnaires")}}" class="btn btn-warning text-white px-4 py-2">
                       Назад в Опросники
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
                                        {{$questionnaire->title}}
                                    </h1>
                                    <div class="flex font-bold text-gray-500 my-3 align-items-center">
                                        <i class="fas fa-clock mr-2 text-success"></i> Дата проведения
                                            {{$questionnaire->start_at->format("H:i d/m/Y")}}
                                            @if ($questionnaire->end_at)
                                                 - {{$questionnaire->end_at->format("H:i d/m/Y")}}
                                            @endif

                                    </div>
                                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-sm lg:text-md dark:text-gray-400">
                                        {!! $questionnaire->description !!}
                                    </p>
                                    @if(in_array(auth()->user()->department_id,json_decode($questionnaire->departments)) && !$result && ($questionnaire->start_at < \Illuminate\Support\Carbon::now()) && ($questionnaire->end_at > \Carbon\Carbon::now()))
                                        <div class="my-3">
                                            <a href="{{route("employee-questionnaire-pass",$questionnaire->id)}}" class="btn btn-success">
                                                Пройти тест
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="order-1 lg:order-2 lg:mt-0 lg:col-span-5 lg:flex my-2">
                                    <img src="/images/question.webp" alt="mockup">
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
