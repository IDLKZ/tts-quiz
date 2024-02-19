@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
        <div class="container mb-5">
            <div class="row">
                <div class="col-12 col-md-9 my-2">
                    <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                        Новость: {{$news->title}}
                    </p>
                </div>
                <div class="col-12 col-md-3 my-2 flex justify-content-end align-items-end">
                    <a href="{{route("employee-news")}}" class="btn btn-warning text-white">
                        <i class="fas fa-newspaper mr-2"></i>Все Новости
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
                            @if(count(json_decode($news->img)) > 1)
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach(json_decode($news->img) as $key => $img)
                                            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                                <div class="rounded-xl z-10 h-[300px] md:h-[400px] lg:h-[600px] brightness-50 w-full bg-cover bg-center bg-no-repeat"
                                                     style="background-image:url({{$img}})"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Пред</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">След</span>
                                    </button>
                                </div>
                            @else
                                <img class="card-img-top img-fluid" src="{{\GuzzleHttp\json_decode($news->img)[0]}}" alt="Card image cap">
                            @endif

                            <div class="card-body">
                                <p class="text-lg font-bold lg:text-xl xl:text-2xl text-black d-inline-block mb-4">{{$news->title}}</p><br/>
                                <p class="text-lg card-subtitle font-size-16 mt-0 font-size-32 text-black d-inline-block mb-4">{{$news->subtitle}}</p><br/>
                                <p class="text-md text-gray-400 d-inline-block mb-4">{{$news->created_at->diffForHumans()}}</p><br/>
                                <hr/>
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
