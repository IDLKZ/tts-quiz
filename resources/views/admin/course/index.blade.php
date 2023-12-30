@extends("layout")
@section("content")
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список курсов</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Список курсов</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{route("course.create")}}" class="btn btn-light btn-rounded dropdown-toggle">
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
                <div class="container mx-auto">
                    <div class="grid grid-cols-12 my-5 gap-4">
                        @foreach($courses as $course)
                            <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-4  my-2">
                                <div class="card h-full shadow-lg rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat bg-cover bg-center" style="background-image:url({{$course->getFile("image_url")}})"></div>
                                    <section class="py-2 px-3">
                                        <div class="header">
                                            <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                                {{\Illuminate\Support\Str::limit($course->title,30,"...")}}
                                            </p>
                                        </div>
                                        <div class="header-subtitle my-3">
                                            <p class="text-md text-gray-300">
                                                {{\Illuminate\Support\Str::limit($course->subtitle,50,"...")}}
                                            </p>
                                        </div>
                                        <div class="flex justify-content-between">
                                            <a href="{{route("course.edit",$course->id)}}" class="btn btn-warning text-white">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            <form action="{{route('course.destroy',$course->id)}}" method="post">
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
                        <div class="col-span-12 flex justify-content-center align-items-center">
                            {{$courses->links()}}
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
