@push("styles")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@extends("layout")
@section("content")
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список идей</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Список идей</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-5 justify-content-center">
                    @if($idea)
                        <div class="col-12 col-lg-6 bg-gray-100">
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
                                        <a href="{{route("user.show",$idea->user_id)}}" class="ml-2 font-bold text-gray-700">
                                            {{$idea->user->name}}
                                        </a>
                                    </div>
                                    <div class="flex text-white">

                                            <button class="mr-1  text-green-500 font-bold text-lg">
                                                <i class="fas fa-thumbs-up text-green-500 mr-1"></i>
                                                {{$idea->up_vote}}
                                            </button>


                                            <button class="ml-1 text-red-500 font-bold text-lg">
                                                <i class="fas fa-thumbs-down text-red-500 mr-1"></i>
                                                {{$idea->down_vote}}
                                            </button>
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
                                    <div class="my-3  font-bold text-lg">
                                        @switch($idea->status)
                                            @case(1)
                                                <p class="text-blue-700">На расcмотрении</p>
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
                            <div class="my-3">
                                <form id="js-form" action="{{route("admin-ideas.update",$idea->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="example-text-input" class=" col-form-label">Изменить статус *</label>
                                        <div>
                                            <select class="form-control"  name="status">

                                                <option @if($idea->status == 0) selected @endif value="0">
                                                   Новая идея
                                                </option>
                                                <option @if($idea->status == -1) selected @endif value="-1">
                                                    Отказано
                                                </option>
                                                <option @if($idea->status == 1) selected @endif value="1">
                                                    На рассмотрении
                                                </option>
                                                <option @if($idea->status == 2) selected @endif value="2">
                                                    Одобрено
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class=" col-form-label">Мнение руводства (необязательно)</label>
                                        <div>
                                            <textarea id="editor" name="opinion">
                                                {!! $idea->opinion !!}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-success text-white">
                                            Изменить
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                </div>
                <!-- end row -->

            </div>
            <!-- end page title end breadcrumb -->


            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
@push("scripts")
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function (){
            ClassicEditor
                .create( document.querySelector( '#editor' ),
                    {
                        ckfinder: {
                            uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
                        }
                    }
                )
                .catch( error => {
                    console.error( error );
                } );

        })

    </script>
@endpush
