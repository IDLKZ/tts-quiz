@extends('layout')
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Главная</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Добро пожаловать!</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <!-- end row -->
                    @if($news)
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2 class="text-white">Актуальные новости</h2>
                            </div>

                            <div class="col-md-8 col-xl-8 offset-md-2">

                                <!-- Simple card -->
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{$news->img}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title font-size-16 mt-0">{{$news->title}}</h4>
                                        <h5 class="card-subtitle font-size-16 mt-0">{{$news->subtitle}}</h5>
                                        <div class="card-text text-truncate">
                                            {!! $news->description !!}
                                        </div>
                                        <a href="{{route("news.show",$news->id)}}" class="btn btn-primary">Читать</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{route("news.index")}}" class="btn btn-primary">Все новости</a>

                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-transparent p-3">
                                    <h5 class="header-title mb-0">Статистика сайта</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="media my-2">

                                            <div class="media-body">
                                                <p class="text-muted mb-2">Компаний</p>
                                                <h5 class="mb-0">{{\App\Models\Company::count()}}</h5>
                                            </div>
                                            <div class="icons-lg ml-2 align-self-center">
                                                <i class="uim uim-layer-group"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media my-2">
                                            <div class="media-body">
                                                <p class="text-muted mb-2">Отделов </p>
                                                <h5 class="mb-0">{{\App\Models\Department::count()}}</h5>
                                            </div>
                                            <div class="icons-lg ml-2 align-self-center">
                                                <i class="uim uim-analytics"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media my-2">
                                            <div class="media-body">
                                                <p class="text-muted mb-2">Сотрудников</p>
                                                <h5 class="mb-0">{{\App\Models\User::where("role_id",2)->count()}}</h5>
                                            </div>
                                            <div class="icons-lg ml-2 align-self-center">
                                                <i class="uim uim-ruler"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media my-2">
                                            <div class="media-body">
                                                <p class="text-muted mb-2">Приглашений</p>
                                                <h5 class="mb-0">{{\App\Models\Invite::count()}}</h5>
                                            </div>
                                            <div class="icons-lg ml-2 align-self-center">
                                                <i class="uim uim-box"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body" id="chart">

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        Корпоративный портал
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            <i class="mdi mdi-heart text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->
    <!-- end main content-->
@endsection
@push("scripts")
    <script src="/js/apexcharts.min.js"></script>
    <script>
        const invites = @json(\App\Models\Invite::count());
        const results = @json(\App\Models\Result::count());
        var optionsChart = {
            series: [invites,results],
            chart: {
                width: "100%",
                type: 'pie',
            },
            labels: ["Приглашения","Результаты"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        (new ApexCharts(document.querySelector("#chart"), optionsChart)).render();


    </script>
@endpush
