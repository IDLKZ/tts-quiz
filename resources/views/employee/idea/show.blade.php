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
                            Идея: {{$idea->title}}
                        </p>
                    </div>
                    <div class="col-12 col-md-3 my-2 flex justify-content-end align-items-end">
                        <a href="{{route("employee-idea.index")}}" class="btn btn-warning text-white">
                            <i class="fas fa-battery-full mr-2"></i>Все Идеи
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-5">
                    @if($idea)
                        <div class="col-12">
                            <!-- Simple card -->
                            <div class="card bg-transparent">
                                <img class="card-img-top img-fluid" src="{{$idea->getFile('image_url')}}" alt="Card image cap">
                                <div class="card-body">
                                    <p class="text-lg font-bold lg:text-xl xl:text-2xl text-black d-inline-block mb-4">{{$idea->title}}</p><br/>
                                    <div class="flex align-items-center my-3">
                                        <div
                                            class="flex items-center
                                                        h-10 w-10
                                                        justify-center
                                                        rounded-full flex-shrink-0
                                                        bg-center bg-no-repeat bg-cover"
                                            style="background-image:url({{$idea->user->img}})"
                                        >
                                        </div>
                                        <p class="ml-2 font-bold text-gray-700">
                                            {{$idea->user->name}}
                                        </p>
                                    </div>
                                    <div class="flex text-white">
                                        <form action="{{route("employee-idea.update",$idea->id)}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input hidden name="rating_user" value="1">
                                            <button type="submit" class="mr-1  text-green-500 font-bold text-lg">
                                                <i class="fas fa-thumbs-up text-green-500 mr-1"></i>
                                                {{$idea->up_vote}}
                                            </button>
                                        </form>
                                        <form action="{{route("employee-idea.update",$idea->id)}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input hidden name="rating_user" value="-1">
                                            <button type="submit" class="ml-1 text-red-500 font-bold text-lg">
                                                <i class="fas fa-thumbs-down text-red-500 mr-1"></i>
                                                {{$idea->down_vote}}
                                            </button>
                                        </form>
                                    </div>
                                    <div class="font-bold text-gray-700 text-sm flex my-2">
                                        @if($idea->keywords)
                                            @foreach($idea->keywords as $keyword)
                                                <small class="mr-1">
                                                    #{{$keyword}}
                                                </small>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="my-3 text-white font-bold text-lg">
                                        @switch($idea->status)
                                            @case(1)
                                                <p class="text-blue-700">На расммотрении</p>
                                                @break
                                            @case(2)
                                                <p class="text-green-700">Удтвержден</p>
                                                @break
                                            @case(-1)
                                                <p class="text-red-700">Отклонен</p>
                                                @break
                                            @default
                                                <p class="text-yellow-700">Еще не просмотрен</p>
                                        @endswitch
                                    </div>
                                    <p class="text-md text-gray-400 d-inline-block mb-4">{{$idea->created_at->diffForHumans()}}</p><br/>
                                    @if($idea->file_url)
                                    <div class="border border-gray-400 p-3 rounded-lg my-4 flex align-items-center">
                                        <a href="{{$idea->getFile("file_url")}}" download class="text-md cursor-pointer font-bold">
                                            <i class="fas fa-file mr-1"></i>
                                            Скачать прикрепленный файл
                                        </a>
                                    </div>
                                    @endif
                                    @if(auth()->id() == $idea->user_id)
                                        <div class="my-2 flex justify-content-end">
                                            <form action="{{route("employee-idea.destroy",$idea->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="ml-1 text-white btn btn-danger bg-red-500 font-bold text-sm rounded-full">
                                                    <i class="fas fa-trash-alt  mr-1"></i>
                                                    Удалить идею
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    <hr/>
                                    <div class="card-text text-md my-4">
                                        {!! $idea->description !!}
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
