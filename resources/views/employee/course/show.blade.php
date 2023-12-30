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
                        Курс
                    </p>
                    <p class="text-md font-bold lg:text-lg">
                        {{$course->title}}
                    </p>
                </div>
                <div class="col-12 col-md-6 my-2 text-right">
                    <a href="{{route("courseListEmployee")}}" class="btn btn-warning text-white px-4 py-2">
                       Назад в Курсы
                    </a>
                </div>
            </div>
        </div>
            <div class="container">
                <div class="row mt-5">

                    @if($course->lessons->isNotEmpty())
                        @foreach($course->lessons as $item)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-4 my-2">
                                <div class="card h-full shadow-lg rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat background-center background-cover" style="min-height:300px;background-image:url({{$item->getFile("image_url")}})"></div>
                                    <section class="py-2 px-3">
                                        <div class="header">
                                            <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                              {{$item->order}}.  {{\Illuminate\Support\Str::limit($item->title,30)}}
                                            </p>
                                        </div>
                                        <div class="header-subtitle my-3">
                                            <p class="text-md text-gray-500">
                                                {{\Illuminate\Support\Str::limit($item->subtitle,30)}}
                                            </p>
                                        </div>
                                        <div class="flex justify-content-center align-items-center text-center py-3">
                                            <a href="{{route("lesson-show-employee",$item->alias)}}" class="btn btn-warning text-white">
                                                <i class="fas fa-eye"></i> Смотреть
                                            </a>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <h5>Пока нет уроков</h5>
                    @endif

                </div>
                <!-- end row -->

            </div>
        <!-- End Page-content -->
        </div>
    </div>
    <!-- end main content-->

@endsection
