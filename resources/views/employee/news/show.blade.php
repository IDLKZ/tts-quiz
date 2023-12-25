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
                        Новость
                    </p>
                    <p class="text-md font-bold lg:text-lg">
                        {{$news->title}}
                    </p>
                </div>
                <div class="col-12 col-md-6 my-2 text-right">
                    <a href="/employee/employee-news" class="btn btn-warning text-white px-4 py-2">
                        Новости
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-5">
                @if($news)
                    <div class="col-12">
                        <!-- Simple card -->
                        <div class="card bg-transparent">
                            <img class="card-img-top img-fluid" src="{{$news->img}}" alt="Card image cap">
                            <div class="card-body">
                                <p class="text-lg font-bold lg:text-xl xl:text-2xl">{{$news->title}}</p>
                                <p class="text-lg card-subtitle font-size-16 mt-0 font-size-32">{{$news->subtitle}}</p>
                                <div class="card-text text-md my-4">
                                    {!! $news->description !!}
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

            </div>
            <!-- end row -->

        </div>
        <!-- End Page-content -->
        </div>
    </div>
    <!-- end main content-->

@endsection
