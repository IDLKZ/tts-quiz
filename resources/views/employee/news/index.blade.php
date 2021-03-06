@extends('layout')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Новости</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('employeeHome')}}">Главная</a></li>
                                <li class="breadcrumb-item active">Новости</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>

            <!-- end row -->

            <!-- end page title end breadcrumb -->
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row mt-5">

                            @if($news->isNotEmpty())
                               @foreach($news as $item)
                                <div class="col-md-4 col-xl-4">
                                    <!-- Simple card -->
                                    <div class="card">
                                        <img class="card-img-top img-fluid" src="{{$item->img}}" style="height: 250px!important;" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title font-size-16 mt-0">{{$item->title}}</h4>
                                            <br>
                                            <h5 class="card-subtitle font-size-16 mt-0">{{$item->subtitle}}</h5>
{{--                                            <div class="card-text text-truncate">--}}
{{--                                                {!! $item->description !!}--}}
{{--                                            </div>--}}
                                            <br>
                                            <a href="{{route("news-show",$item->id)}}" class="btn btn-primary">Читать</a>
                                        </div>
                                    </div>
                                </div>
                                   {{$news->links()}}
                            @endforeach
                            @else
                                <h5>Пока новостей нет</h5>
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

