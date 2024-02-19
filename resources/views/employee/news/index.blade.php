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
                            Список Новостей
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список текущих новостей.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->

            <!-- end row -->

            <!-- end page title end breadcrumb -->
            <div class="container">
                <div class="row mt-5">

                    @if($news->isNotEmpty())
                        @foreach($news as $item)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-4 my-2">
                                <div class="card h-full shadow-lg rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat background-center background-cover" style="min-height:300px;background-image:url({{\GuzzleHttp\json_decode($item->img)[0]}})"></div>
                                    <section class="py-2 px-3 h-full relative">
                                            <div class="header">
                                                <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                                    {{\Illuminate\Support\Str::limit($item->title,30)}}
                                                </p>
                                            </div>
                                            <div class="header-subtitle mt-3 mb-5">
                                                <p class="text-md text-gray-300">
                                                    {{\Illuminate\Support\Str::limit($item->subtitle,30)}}
                                                </p>
                                            </div>
                                        <div class="absolute bottom-[15px] right-[15px]">
                                            <a href="{{route("news-show",$item->id)}}" class="btn btn-warning text-white">
                                                <i class="fas fa-eye"></i> Читать
                                            </a>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 my-2 flex justify-content-center align-items-center text-center">
                            {{$news->links()}}
                        </div>
                    @else
                        <h5>Пока новостей нет</h5>
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

