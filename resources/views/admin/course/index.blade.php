@extends("layout")
@section("content")
    <div class="main-content">
        <div class="page-content">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p class="md:text-lg lg:text-2xl">
                                Список курсов
                            </p>
                            <p class="text-sm lg:text-md">
                                Здесь вы можете увидеть список курсов
                            </p>
                        </div>
                        <div class="col-12 col-md-6 text-right">
                            <a href="{{route("course.create")}}" class="btn btn-primary">Создать курс</a>
                        </div>
                    </div>

                    <div class="row my-5">
                        @foreach($courses as $course)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-2">
                                <div class="card h-full shadow-lg rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat bg-cover bg-center" style="background-image:url({{$course->getFile("image_url")}})"></div>
                                    <section class="py-2 px-3">
                                        <div class="header">
                                            <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                                {{$course->title}}
                                            </p>
                                        </div>
                                        <div class="header-subtitle my-3">
                                            <p class="text-md lg:text-lg font-bold text-black">
                                                {{$course->subtitle}}
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
                            <div class="col-12 flex justify-content-center align-items-center">
                                {{$courses->links()}}
                            </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
