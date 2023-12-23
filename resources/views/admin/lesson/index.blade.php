@extends("layout")
@section("content")
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список уроков</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Список уроков</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{route("lesson.create")}}" class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi mdi-plus-thick  mr-1"></i> Добавить
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container">
                    <div class="row my-5">
                        @foreach($lessons as $lesson)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-3">
                                <div class="card h-full shadow-lg rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat background-cover" style="background-image:url({{$lesson->getFile("image_url")}})"></div>
                                    <section class="py-2 px-3">
                                        <div class="header">
                                            <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                                {{$lesson->order}}  {{$lesson->title}}
                                            </p>
                                        </div>
                                        <div class="header-subtitle my-3">
                                            <p class="text-md lg:text-lg font-bold text-black">
                                                {{$lesson->subtitle}}
                                            </p>
                                        </div>
                                        <div class="header-subtitle my-3">
                                            <a href="{{route("course.edit",$lesson->course_id)}}" class="text-sm font-bold text-gray">
                                                #{{$lesson->course->title}}
                                            </a>
                                        </div>
                                        <div class="flex justify-content-between">
                                            <a href="{{route("lesson.edit",$lesson->id)}}" class="btn btn-warning text-white">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="{{route('lesson.destroy',$lesson->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bg-danger text-white">
                                                    <i class="far fa-times-circle"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 flex justify-content-center align-items-center">
                            {{$lessons->links()}}
                        </div>
                    </div>
                    <!-- end col -->
                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
