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
                                    <h4 class="header-title">Тесты Соловьева</h4>
                                    <p class="card-title-desc">
                                        Определяет мотивы, мотивацию,уровень соответсвия должности, позволяя произвести анализ профессиональные качества сотрудника
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <div class="row">
                    @foreach($motives as $motive)
                        <div class="col-12 mt-2 py-3">
                            <div class="row bg-white">
                                <div class="col-xl-6 d-flex justify-content-center align-items-center">
                                    <div>
                                        <div class="chart" id="chart{{$motive->motive_id}}"
                                             data-percentage = "{{$motive->percentage}}"
                                             data-id="{{$motive->motive_id}}"
                                             data-title="{{$motive->motive->title}}"
                                        >
                                        </div>
                                        <div class="donut" id="donut{{$motive->motive_id}}"
                                             data-rating = "{{$motive->rating}}"
                                             data-id="{{$motive->motive_id}}"
                                             data-title="{{$motive->motive->title}}"
                                        ></div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                        <div class="card">
                                            <img class="card-img-top img-fluid" src="{{$all_motives[$motive->motive_id][0]["img"]}}" alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-title font-size-16 mt-0">{{$all_motives[$motive->motive_id][0]["title"]}}</h4>
{{--                                               Description--}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#description{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Описание
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="description{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text">
                                                                    {{$all_motives[$motive->motive_id][0]["description"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
{{--                                                Motivation--}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#motivation{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Мотивация
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="motivation{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["motivation"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
{{--                                                --}}
{{--                                                Loyalty--}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#loyal{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Лояльность
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="loyal{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["loyal"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
{{--                                            Salary    --}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#salary{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Заработная плата
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="salary{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["salary"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                            Relationship         --}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#relationship{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Отношения
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="relationship{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["relationship"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                            Rule --}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#rule{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Правила
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="rule{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["rule"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                             Head--}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#head{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Управление
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="head{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["head"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                            Strength    --}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#strength{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Сильные стороны
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="strength{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["strength"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                            Weakness    --}}
                                                <div class="accordion" >
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#weakness{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    Слабые стороны
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="weakness{{$motive->motive_id}}" class="collapse" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                <p class="card-text font-size-12">
                                                                    {{$all_motives[$motive->motive_id][0]["weakness"]}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



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

                                    <h4 class="header-title">Результаты по мотивам</h4>
                                    <p class="card-title-desc">
                                        Результаты по мотивам
                                    </p>

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">ФИО Сотрудника</th>
                                                    <th class="text-center">Мотив</th>
                                                    <th class="text-center">Балл</th>
                                                    <th class="text-center">В процентах %</th>
                                                    <th class="text-center">Значение</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($motives as $motive)
                                                <tr>
                                                    <th class="text-center">{{$result->user->name}}</th>
                                                    <td class="text-center">{{$motive->motive->title}}</td>
                                                    <td class="text-center">{{$motive->rating}}</td>
                                                    <td class="text-center">{{$motive->percentage}}</td>
                                                    <td class="text-center">{{$motive->meaning}}</td>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" id="motive-chart">




                                </div>
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
        $("document").ready(function () {
            $(".chart").each(function () {
                let item  = this.id;
                let percentage = $(this).attr('data-percentage');
                let id = $(this).attr('data-id');
                let title = $(this).attr('data-title');
                let colors = {1:"#3399ff",2:"#028e8f",3:"#529cc6",4:"#75c147",5:"#008a4e",6:"#53bfb4"}
                var options = {[item]:{
                    series: [+percentage, 100-percentage],
                    chart: {
                        width: "100%",
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
                (new ApexCharts(document.querySelector("#"+item), options[item])).render();
                // chart.render();
            })
            $(".donut").each(function () {
                let item  = this.id;
                let rating = $(this).attr('data-rating');
                let id = $(this).attr('data-id');
                let title = $(this).attr('data-title');
                let colors = {1:"#3399ff",2:"#028e8f",3:"#529cc6",4:"#75c147",5:"#008a4e",6:"#53bfb4"}
                var options = {[item]: {
                        labels: [title],
                        chart: {
                            type: 'donut',
                        },
                        plotOptions: {
                            pie: {
                                donut: {

                                    labels: {
                                        show: true,
                                        name: {
                                            show: true,
                                            fontSize: '22px',
                                            fontFamily: 'Rubik',
                                            color: '#dfsda',
                                            offsetY: -10
                                        },
                                        value: {
                                            show: true,
                                            fontSize: '16px',
                                            fontFamily: 'Helvetica, Arial, sans-serif',
                                            color: undefined,
                                            offsetY: 22,
                                            formatter: function (val) {
                                                return val
                                            }
                                        },
                                        total: {
                                            show: true,
                                            label: title,
                                            color: '#373d3f',
                                            fontSize:22,
                                            formatter: function (w) {
                                                return w.globals.seriesTotals.reduce((a, b) => {
                                                    return a + b
                                                }, 0)
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        series: [+rating],
                        fill: {
                            colors: [colors[id],]
                        },
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 350
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    }};
                (new ApexCharts(document.querySelector("#"+item), options[item])).render();
                // chart.render();
            });

            let motives = @json($motives);
            console.log(motives)
            var options = {
                series: [{
                    name: 'Мотивы',
                    data: [44, 55, 41, 67, 22, 43, 21, 33, 45, 31, 87, 65, 35]
                }],
                annotations: {
                    points: [{
                        x: 'Bananas',
                        seriesIndex: 0,
                        label: {
                            borderColor: '#775DD0',
                            offsetY: 0,
                            style: {
                                color: '#fff',
                                background: '#775DD0',
                            },
                            text: 'Bananas are good',
                        }
                    }]
                },
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2
                },

                grid: {
                    row: {
                        colors: ['#fff', '#f2f2f2']
                    }
                },
                xaxis: {
                    labels: {
                        rotate: -45
                    },
                    categories: [],
                    tickPlacement: 'on'
                },
                yaxis: {
                    title: {
                        text: 'Набранные баллы',
                    },
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "horizontal",
                        shadeIntensity: 0.25,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 0.85,
                        opacityTo: 0.85,
                        stops: [50, 0, 100]
                    },
                }
            };

            var motive = new ApexCharts(document.querySelector("#motive-chart"), options);
            motive.render();

        })





    </script>
@endpush
