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
                            Список Курсов
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список курсов.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->

            <!-- end row -->

            <!-- end page title end breadcrumb -->
            <div class="container">
                <div class="row mt-5">

                    @if($courses->isNotEmpty())
                        @foreach($courses as $item)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-4 my-2">
                                <div class="card h-full shadow-lg rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat background-center background-cover" style="min-height:300px;background-image:url({{$item->getFile("image_url")}})"></div>
                                    <section class="py-2 px-3">
                                        <div class="header">
                                            <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                                {{strlen($item->title) > 30 ? substr($item->title,0,29) .'...' : $item->title}}
                                            </p>
                                        </div>
                                        <div class="header-subtitle my-3">
                                            <p class="text-md lg:text-lg font-bold text-black">
                                                {{strlen($item->subtitle) > 50 ? substr($item->subtitle,0,49) .'...' : $item->subtitle}}
                                            </p>
                                        </div>
                                        <div class="flex justify-content-center align-items-center text-center py-3">
                                            <a href="{{route("course-show-employee",$item->alias)}}" class="btn btn-warning text-white">
                                                <i class="fas fa-eye"></i> Смотреть
                                            </a>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 my-2 flex justify-content-center align-items-center text-center">
                            {{$courses->links()}}
                        </div>
                    @else
                        <h5>Пока курсов нет</h5>
                    @endif

                </div>
                <!-- end row -->

            </div>

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection

