@extends("layout")
@section("content")
    <div class="main-content">
        <div class="page-content">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p class="md:text-lg lg:text-2xl">
                                Список видеоуроков
                            </p>
                            <p class="text-sm lg:text-md">
                                Здесь вы можете увидеть список видеоуроков
                            </p>
                        </div>
                        <div class="col-12 col-md-6 text-right">
                            <a href="{{route("lesson.create")}}" class="btn btn-primary">Создать видеоурок</a>
                        </div>
                    </div>

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
                </div>
        </div>
    </div>
@endsection
