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
                            <h4 class="page-title mb-1">Приглашения</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/employee">Главная</a></li>
                                <li class="breadcrumb-item active">Приглашения</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        @if($invites->isNotEmpty())
                            @foreach($invites as $invite)
                                 <div class="col-md-6 col-xl-4">

                            <!-- Simple card -->
                            <div class="card">
                                <img class="card-img-top img-fluid" src="{{asset("/images/quiz.jpg")}}" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title font-size-16 mt-0">
                                        {{$invite->title}}
                                    </h4>
                                    <p class="card-text">Тип теста: {{$invite->type->title}}</p>
                                    <p class="card-text">Отдел: {{$invite->department->title}}</p>
                                    <p class="card-text">Сотрудник(и): {{$invite->user ? $invite->user->name : "Все сотрудники отдела"}}</p>
                                    <p class="card-text">Начало: {{\Carbon\Carbon::parse($invite->start)->diffForHumans()}}</p>
                                    <p class="card-text">Окончание: {{\Carbon\Carbon::parse($invite->end)->diffForHumans()}}</p>
                                    <a href="{{$invite->type_id == 1 ? route('solovievQuiz',$invite->id) : ""}}" class="btn btn-primary waves-effect waves-light">Сдать тест!</a>
                                </div>
                            </div>

                        </div><!-- end col -->
                            @endforeach
                            @else
                            <h4 class="text-danger">Предстоящих тестов нет</h4>
                        @endif
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
