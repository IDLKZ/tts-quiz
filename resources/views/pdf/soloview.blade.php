<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Личный кабинет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Корпоративнй портал" name="description" />
    <meta content="Корпоративный портал" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: Roboto;
            font-size: 12px!important;
        }
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 12px;
            text-align: center;
        }


    </style>
</head>

<body data-topbar="colored">
<section id="report">
    <div class="page-content" >

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h4 class="page-title mb-1">Результаты Теста - {{$invite->title}} Сотрудника {{$invite->user->name}}</h4>
                        <h4 class="page-title mb-1">Страница для распечатки</h4>
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
                    @foreach($motives as $motive)
                        @if($loop->iteration != 1 && !$loop->last - 1)
                        <div class="html2pdf__page-break"></div>
                    @endif

                    <div class="row py-2">
                        <div class="col-12 mt-2 py-3">
                            <div class="row bg-white">
                                <div class="col-xl-12 d-flex justify-content-center align-items-center">
                                    <div class="w-100">
                                        <div class="donut text-center my-5">
                                            <h1>Мотив {{$motive->motive->title}}:</h1>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img class="card-img-top img-fluid" src="{{$all_motives[$motive->motive_id][0]["img"]}}" alt="Card image cap" style="width: 50%">
                                        </div>
                                        <div class="card-body">
                                            {{--                                               Description--}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#description{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Описание
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="description{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text">
                                                                        {{$all_motives[$motive->motive_id][0]["description"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#motivation{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Мотивация
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="motivation{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["motivation"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#loyal{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Лояльность
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="loyal{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["loyal"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#salary{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Заработная плата
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="salary{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["salary"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#relationship{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Отношения
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="relationship{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["relationship"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#rule{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Правила
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="rule{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["rule"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#head{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Управление
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="head{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["head"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#strength{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Сильные стороны
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="strength{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["strength"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="accordion" >
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link nav-link text-black-50 text-bold" type="button" data-toggle="collapse" data-target="#weakness{{$motive->motive_id}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Слабые стороны
                                                                    </button>
                                                                </h2>
                                                            </div>

                                                            <div id="weakness{{$motive->motive_id}}" class="collapse show" aria-labelledby="headingOne">
                                                                <div class="card-body">
                                                                    <p class="card-text font-size-12">
                                                                        {{$all_motives[$motive->motive_id][0]["weakness"]}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 d-flex justify-content-center align-items-center">
                                                    <div class="w-100">
                                                        <div class="donut text-center my-5">
                                                            <h1>Итого по Мотиву {{$motive->motive->title}}:</h1>
                                                            <h1>{{$motive->rating}}</h1>
                                                        </div>
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
                <!-- end row -->
                {{--                    Table--}}
                <div class="html2pdf__page-break"></div>
                <div class="row py-2">
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
                {{--                    Another Table--}}
                <div class="html2pdf__page-break"></div>
                <div class="row py-2">
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

                {{--                    Table--}}
                <div class="html2pdf__page-break"></div>
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


</section>
<button type="button" id="print" onclick="printDoc()" class="btn btn-success btn-circle btn-xl" style="position: fixed; bottom: 40px; right: 40px;">
    <i class="fa fa-print" style="font-size: 24px"></i>
</button>


<!-- END layout-wrapper -->
<!-- Laravel Javascript Validation -->

<script src="{{asset('js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js" integrity="sha512-vDKWohFHe2vkVWXHp3tKvIxxXg0pJxeid5eo+UjdjME3DBFBn2F8yWOE0XmiFcFbXxrEOR1JriWEno5Ckpn15A==" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



        <script>
            swal("Страница распечатки!", "Вы можете перевести эту страницу в PDF", "success");
        function printDoc(){
            swal("Ждем!", "Ваш Файл готовится к переводу в PDF!", "success");
            var element = document.getElementById('report');
            html2pdf(element);
        }


</script>
