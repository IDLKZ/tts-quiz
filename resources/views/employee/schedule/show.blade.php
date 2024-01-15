@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container my-2">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl text-black">
                           Рабочий график
                        </p>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->

            <!-- end row -->

            <!-- end page title end breadcrumb -->

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->
        <div class="container">
            <div class="row">
                <div class="col-12 my-2">
                    <div class="block  p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                        <p class="mb-2 text-md md:text-lg font-bold tracking-tight text-gray-900">{{$schedule->title}}</p>
                        <div class="flex my-2 align-items-center">
                            <img class="mr-2 w-6 h-6 rounded-full" src="{{$schedule->user->img}}">
                            <p class="text-sm font-bold text-gray-700 dark:text-gray-400 ml-2">
                                {{$schedule->user->name}}
                            </p>
                        </div>
                        <p class="text-md text-success">
                            <i class="fas fa-calendar mr-2"></i>{{$schedule->start_at->format("d/m/Y H:i")}} -  {{$schedule->end_at->format("d/m/Y H:i")}}
                        </p>
                        <p class="text-sm font-normal text-gray-700 dark:text-gray-400">
                            {!! $schedule->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content-->

@endsection
