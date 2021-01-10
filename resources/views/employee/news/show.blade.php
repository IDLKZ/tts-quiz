@extends('layout')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-newss-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Новости</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-news"><a href="{{route('employeeHome')}}">Главная</a></li>
                                <li class="breadcrumb-news active">Новости</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row mt-5">

                        @if($news)

                                <div class="col-md-8 col-xl-8 offset-md-2">
                                    <!-- Simple card -->
                                    <div class="card">
                                        <img class="card-img-top img-fluid" src="{{$news->img}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title font-size-16 mt-0">{{$news->title}}</h4>
                                            <h5 class="card-subtitle font-size-16 mt-0">{{$news->subtitle}}</h5>
                                            <div class="card-text">
                                                {!! $news->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        @endif

                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->
            </div>

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
