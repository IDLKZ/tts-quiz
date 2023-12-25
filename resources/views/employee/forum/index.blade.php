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
                            Форумы
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                           Список форумов
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2 text-right">
                        <a href="{{route("forumCreate")}}" class="btn btn-warning text-white px-4 py-2">
                            Создать форум
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-5">
                @foreach($forums as $forum)
                        <div class="col-12 my-2">
                            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
                                <div class="my-3 flex align-items-center">
                                    <img class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr" src="{{$forum->user->img}}">
                                    <p class="text-md lg:text-lg ml-3">
                                        {{$forum->user->name}}
                                    </p>
                                </div>
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{$forum->title}}
                                    </h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {!! (strlen($forum->description) > 50 ? substr($forum->description,49) ."..." : $forum->description) !!}
                                </p>
                                <div class="my-4">
                                    <a href="{{route("forumDetail",$forum->id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Подробнее
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                @endforeach


                </div>
                <!-- end row -->

            </div>
            <!-- End Page-content -->
        </div>
    </div>
    <!-- end main content-->

@endsection
