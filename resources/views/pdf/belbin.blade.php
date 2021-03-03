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
    <div class="page-content">

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Тесты Белбина Сотрудника {{$result->user->name}}</h4>
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
                                <div class="col-md-6 d-flex justify-content-center align-items-center">
                                    <div class="text-center">
                                    <h1>Итого {{$belbin->rating}}/70</h1>
                                    <h1>Итого {{$belbin->percentage}}/100%</h1>
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


            </div>
            <!-- end container-fluid -->
        </div>

        <!-- end page-content-wrapper -->
    </div>


</section>
<a href="{{route("admin-belbin-show",["userId"=>$result->user->id,"id"=>$result->id])}}" type="button"  class="btn btn-success btn-circle btn-xl d-flex justify-content-center align-items-center text-white" style="position: fixed; bottom: 40px; left: 40px;">
    <i class="fa fa-arrow-left" style="font-size: 24px"></i>
</a>
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

