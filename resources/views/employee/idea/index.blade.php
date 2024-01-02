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
                            Список идей
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список идей.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2">
                        <div class="float-right d-block">
                            <div class="dropdown">
                                <a href="{{route("employee-idea.create")}}" class="btn btn-warning text-white btn-rounded dropdown-toggle">
                                    <i class="mdi mdi mdi-plus-thick  mr-1"></i> Предложить идею
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="grid grid-cols-12">
                    @foreach($ideas as $idea)
                        <div class="col-span-12 lg:col-span-9">
                            <a href="{{route("employee-idea.show",$idea->id)}}">
                                <div class="card bg-transparent shadow-lg relative min-h-[500px]">
                                    <div class="absolute bg-center bg-cover rounded-xl w-full h-full bg-no-repeat brightness-50 z-10" style="background-image:url({{$idea->getFile("image_url")}})"></div>
                                    <div class="absolute z-20 bottom-[10%] left-[5%]">
                                        <div class="flex align-items-center">
                                            <div
                                                class="flex items-center
                                                        h-10 w-10
                                                        justify-center
                                                        rounded-full flex-shrink-0
                                                        bg-center bg-no-repeat bg-cover"
                                                style="background-image:url({{$idea->user->img}})"
                                            >
                                            </div>
                                            <p class="ml-2 font-bold text-white">
                                                {{$idea->user->name}}
                                                <br/>
                                                <small>
                                                    {{$idea->created_at->format("H:i d/m/Y")}}
                                                </small>
                                            </p>
                                        </div>
                                        <section class="my-2">
                                            <p class="font-bold text-white text-md lg:text-lg xl:text-2xl">
                                                {{\Illuminate\Support\Str::limit($idea->title,30)}}
                                            </p>
                                            <div class="font-bold text-white text-sm">
                                                {!! \Illuminate\Support\Str::limit($idea->description,80) !!}
                                            </div>
                                        </section>
                                        <div class="font-bold text-white text-sm flex my-2">
                                            @if($idea->keywords)
                                                @foreach($idea->keywords as $keyword)
                                                    <small class="mr-1">
                                                        #{{$keyword}}
                                                    </small>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="flex text-white">
                                            <p class="mr-1  text-green-500 font-bold text-lg">
                                                <i class="fas fa-thumbs-up text-green-500 mr-1"></i>
                                                {{$idea->up_vote}}
                                            </p>
                                            <p class="ml-1 text-red-500 font-bold text-lg">
                                                <i class="fas fa-thumbs-down text-red-500 mr-1"></i>
                                                {{$idea->down_vote}}
                                            </p>
                                        </div>
                                        <div class="my-3 text-white font-bold text-lg">
                                            @switch($idea->status)
                                                @case(1)
                                                    <p class="text-blue-200">На расммотрении</p>
                                                @break
                                                @case(2)
                                                    <p class="text-green-200">Удтвержден</p>
                                                @break
                                                @case(-1)
                                                    <p class="text-red-200">Отклонен</p>
                                                @break
                                                @default
                                                    <p class="text-yellow-200">Еще не просмотрен</p>
                                            @endswitch

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-span-12 lg:col-span-9 my-2 flex justify-content-center align-items-center">
                        {{$ideas->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection


