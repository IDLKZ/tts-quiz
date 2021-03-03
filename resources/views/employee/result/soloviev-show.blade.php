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
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Результаты Теста - {{$invite->title}}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/employee">Главная</a></li>
                                <li class="breadcrumb-item active">Результаты {{$result->user->name}}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <a href="{{route("admin-soloview-show-pdf",["userId"=>$result->user->id,"id"=>$result->id])}}" class="btn btn-light btn-rounded dropdown-toggle">
                                            <i class="fas fa-print"></i> Распечатать
                                        </a>
                                    </div>
                                </div>
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
                                    <div class="w-100">
                                        <div class="chart" id="chart{{$motive->motive_id}}"
                                             data-percentage = "{{$motive->percentage}}"
                                             data-id="{{$motive->motive_id}}"
                                             data-title="{{$motive->motive->title}}"
                                        >
                                        </div>
                                        <div class="donut text-center my-5" id="donut{{$motive->motive_id}}"
                                             data-rating = "{{$motive->rating}}"
                                             data-id="{{$motive->motive_id}}"
                                             data-title="{{$motive->motive->title}}"
                                        >
                                            <h1>Мотив {{$motive->motive->title}}:</h1>
                                            <h1>{{$motive->rating}}</h1>



                                        </div>
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
{{--                    Charts--}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" id="motive-chart"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" id="motive-chart-rating"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
{{--                    Another Table--}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="header-title">Уровень соответствия</h4>
                                    <p class="card-title-desc">
                                        Результаты по мотивам и уровень соответствия
                                    </p>

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">ФИО Сотрудника</th>
                                                    <th class="text-center">Должность на момент сдачи</th>
                                                    <th class="text-center">Мотив</th>
                                                    <th class="text-center">Набранный процент %</th>
                                                    <th class="text-center">Минимум для должности %</th>
                                                    <th class="text-center">Максимум для должности %</th>
                                                    <th class="text-center">Значение</th>
                                                    <th class="text-center">Результат</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($motives as $motive)
                                                    <tr>
                                                        <th class="text-center">{{$result->user->name}}</th>
                                                        <th class="text-center">{{$result->position}}</th>
                                                        <td class="text-center">{{$motive->motive->title}}</td>
                                                        <td class="text-center">{{$motive->percentage}}</td>
                                                        <td class="text-center">{{$job_motive[$motive->motive_id][0]["min"]}}</td>
                                                        <td class="text-center">{{$job_motive[$motive->motive_id][0]["max"]}}</td>
                                                        <td class="text-center">{{$job_motive[$motive->motive_id][0]["status"] == 1 ? 'Желательный мотив' : ($job_motive[$motive->motive_id][0]["status"] == -1  ? "Нежелательный мотив" :"Нейтральный мотив")}}</td>
                                                        <td class="text-center">
                                                            @switch($motive->percentage)
                                                                @case($motive->percentage >= $job_motive[$motive->motive_id][0]["min"] &&  $motive->percentage <= $job_motive[$motive->motive_id][0]["max"])
                                                                    Соответствует
                                                                @break
                                                                @case(8 > $job_motive[$motive->motive_id][0]["min"] - $motive->percentage)
                                                                Небольшая разница
                                                                @break
                                                                @default
                                                                Высокая разница
                                                                @endswitch
                                                        </td>



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
{{--Chart--}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" id="chart-diff"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>
{{--                    Table--}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="header-title">Результаты по шкалам</h4>
                                    <p class="card-title-desc">
                                        Результаты по шкалам
                                    </p>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">ФИО Сотрудника</th>
                                                    <th class="text-center">Шкала</th>
                                                    <th class="text-center">Описание</th>
                                                    <th class="text-center">Балл</th>
                                                    <th class="text-center">В процентах %</th>
                                                    <th class="text-center">Значение</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($scales as $scale)
                                                    <tr>
                                                        <th class="text-center">{{$result->user->name}}</th>
                                                        <td class="text-center">{{$scale->scale->title}}</td>
                                                        <td class="text-center">{{$scale->scale->description}}</td>
                                                        <td class="text-center">{{$scale->rating}}</td>
                                                        <td class="text-center">{{$scale->percentage}}</td>
                                                        <td class="text-center">{{$scale->meaning}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h4 class="header-title">Результаты по зависимости испытуемого от работы</h4>
                                    <p class="card-title-desc">
                                        Результаты по зависимости испытуемого от работы
                                    </p>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">ФИО Сотрудника</th>
                                                    <th class="text-center">Уровень зависимости</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($meaning as $item)
                                                    <tr>
                                                        <th class="text-center">{{$result->user->name}}</th>
                                                        <td class="text-center">{{$item->meaning}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <h4 class="header-title">Общий уровень мотивации</h4>
                                    <p class="card-title-desc">
                                        Результаты к мотивации испытуемого к работе
                                    </p>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                <tr>

                                                    <th class="text-center">ФИО Сотрудника</th>
                                                    <th class="text-center">Набранные баллы</th>
                                                    <th class="text-center">Уровень мотивации</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($motivation as $item)
                                                    <tr>
                                                        <th class="text-center">{{$result->user->name}}</th>
                                                        <th class="text-center">{{$item->rating}}</th>
                                                        <td class="text-center">{{$item->meaning}}</td>
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
            // $(".donut").each(function () {
            //     let item  = this.id;
            //     let rating = $(this).attr('data-rating');
            //     let id = $(this).attr('data-id');
            //     let title = $(this).attr('data-title');
            //     let colors = {1:"#3399ff",2:"#028e8f",3:"#529cc6",4:"#75c147",5:"#008a4e",6:"#53bfb4"}
            //     var optionsDonut = {[item]: {
            //             labels: [title],
            //             chart: {
            //                 type: 'donut',
            //             },
            //             dataLabels:{
            //                 enabled:false
            //             },
            //             plotOptions: {
            //                 pie: {
            //                     donut: {
            //                         labels: {
            //                             show: true,
            //                             name: {
            //                                 show: true,
            //                                 fontSize: '22px',
            //                                 fontFamily: 'Rubik',
            //                                 color: '#dfsda',
            //                                 offsetY: -10
            //                             },
            //                             value: {
            //                                 show: true,
            //                                 fontSize: '22px',
            //                                 fontFamily: 'Helvetica, Arial, sans-serif',
            //                                 color: undefined,
            //                                 offsetY: 22,
            //                                 formatter: function (val) {
            //                                     return val + "баллов"
            //                                 }
            //                             },
            //                             total: {
            //                                 show: true,
            //                                 label: title,
            //                                 color: '#373d3f',
            //                                 fontSize:22,
            //                                 formatter: function (w) {
            //                                     return w.globals.seriesTotals.reduce((a, b) => {
            //                                         return a + b
            //                                     }, 0)
            //                                 }
            //                             }
            //                         }
            //                     }
            //                 }
            //             },
            //             series: [+rating],
            //             fill: {
            //                 colors: [colors[id],]
            //             },
            //             responsive: [{
            //                 breakpoint: 480,
            //                 options: {
            //                     chart: {
            //                         width: 350
            //                     },
            //                     legend: {
            //                         position: 'bottom'
            //                     }
            //                 }
            //             }]
            //         }};
            //     (new ApexCharts(document.querySelector("#"+item), optionsDonut[item])).render();
            //     // chart.render();
            // });

            let motives = @json($motives);
            let job_motives = @json($job_motive);
            let rating = [];
            let percentage = [];
            let titles = [];
            let min_percentage = [];
            let max_percentage = [];
            for (key in motives){
                rating.push(motives[key].rating);
                percentage.push(motives[key].percentage);
                titles.push(motives[key].motive.title);
                min_percentage.push(job_motives[motives[key].motive_id][0].min);
                max_percentage.push(job_motives[motives[key].motive_id][0].max);
            }



            var motiveOptions = {
                series: [{
                    name: 'В процентах',
                    data: percentage
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "%";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: titles,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "%";
                        }
                    }

                },
                title: {
                    text: 'Мотивы в процентах',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };
            var motive = new ApexCharts(document.querySelector("#motive-chart"), motiveOptions);
            motive.render();
            var motiveOptions2 = {
                series: [{
                    name: 'В баллах',
                    data: rating
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: titles,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val;
                        }
                    }

                },
                title: {
                    text: 'Мотивы в баллах',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };
            var motive2 = new ApexCharts(document.querySelector("#motive-chart-rating"), motiveOptions2);
            motive2.render();

            var optionsDiff = {
                series: [{
                    name: 'Результаты в процентах',
                    data: percentage
                }, {
                    name: 'Необходимый минимум',
                    data: min_percentage
                }, {
                    name: 'Необходимый максимум',
                    data: max_percentage
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: titles,
                },
                yaxis: {
                    title: {
                        text: 'Баллы в %'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " %"
                        }
                    }
                }
            };

            var chartDiff = new ApexCharts(document.querySelector("#chart-diff"), optionsDiff);
            chartDiff.render();





        })





    </script>

@endpush
