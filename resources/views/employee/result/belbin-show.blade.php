@extends('layout')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Результаты Теста - {{$invite->title}}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/employee">Главная</a></li>
                                <li class="breadcrumb-item active">Результаты {{$result->user->name}}</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Тесты Белбина</h4>
                                    <p class="card-title-desc">
                                        На основании исследований Рэймонд Мередит Белбин выделил 8 типов ролей, которые исполняет человек в зависимости от личных особенностей и качеств:
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <div class="row">
                        @foreach($belbin_user as $belbin)
                            <div class="col-12 mt-2 py-3">
                                <div class="row bg-white">
                                    <div class="col-xl-6 d-flex justify-content-center align-items-center">
                                        <div class="w-100">
                                                <div class="chart" id="chart{{$belbin->role_id}}"
                                                     data-percentage = "{{$belbin->percentage}}"
                                                     data-title="{{$belbin->belbinRole->title}}"
                                                     data-id="{{$belbin->role_id}}"
                                                >
                                                </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <img class="card-img-top img-fluid" src="{{$belbin->belbinRole->img}}" alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-title font-size-16 mt-0">{{$belbin->belbinRole->title}}</h4>
                                                <p class="card-text">
                                                    {{$belbin->belbinRole->description}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                    </div>
                    <!-- end row -->
                    {{--                    Table--}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="header-title">Результаты по тесту Белбина</h4>
                                    <p class="card-title-desc">
                                        Результаты по командной роли
                                    </p>

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">ФИО Сотрудника</th>
                                                    <th class="text-center">Роль</th>
                                                    <th class="text-center">Балл</th>
                                                    <th class="text-center">В процентах %</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($belbin_user as $belbin)
                                                    <tr>
                                                        <th class="text-center">{{$result->user->name}}</th>
                                                        <td class="text-center">{{$belbin->belbinRole->title}}</td>
                                                        <td class="text-center">{{$belbin->rating}}</td>
                                                        <td class="text-center">{{$belbin->percentage}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>

{{--                    Chart--}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" id="chart-diff"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
{{--                    Chart--}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" id="chart-roles"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
                <!-- end container-fluid -->
            </div>

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->



@endsection
@push("scripts")
    <script src="/js/apexcharts.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".chart").each(function () {
                let item  = this.id;
                let percentage = $(this).attr('data-percentage');
                let id = $(this).attr('data-id');
                let title = $(this).attr('data-title');
                let colors = {1:"#01f87b",2:"#028e8f",3:"#529cc6",4:"#1288be",5:"#008a4e",6:"#53bfb4",7:"#75c147",8:"#056ae2"}
                var optionsChart = {[item]:{
                        series: [+percentage, 100-percentage],
                        chart: {
                            width: '100%',
                            type: 'pie',
                        },
                        colors:[colors[id], '#efefef'],
                        fill: {
                            colors: [colors[id], '#efefef']
                        },
                        labels: [title,"Остальное"],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 350
                                },
                                legend: {
                                    position: 'top'
                                }
                            }
                        }]
                    }};
                (new ApexCharts(document.querySelector("#"+item), optionsChart[item])).render();
                // chart.render();
            })

            let belbinUser = (@json($belbin_user));
            let rating = [];
            let percentage = [];
            let title = [];
            for(key in belbinUser){
                rating.push(+belbinUser[key].rating);
                percentage.push(+belbinUser[key].percentage);
                title.push(belbinUser[key].belbin_role.title);
            }



            var optionsDiff = {
                series: [{
                    name:"Баллы",
                    data: rating
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                legend:{
                  show:false,
                },
                dataLabels: {
                    enabled: true,
                },
                xaxis: {
                    categories: title,
                },
                tooltip: {
                    y: {
                        formatter: function (value, series) {
                            return value + " из  70"
                        }
                    }
                },

            };

            (new ApexCharts(document.querySelector("#chart-diff"), optionsDiff)).render();

            var optionsChart = {
                series: percentage,
                chart: {
                    width: "100%",
                    type: 'pie',
                },
                labels: title,
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

            (new ApexCharts(document.querySelector("#chart-roles"), optionsChart)).render();

        })
    </script>

@endpush
