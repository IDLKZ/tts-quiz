@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Приглашения</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("invite")}}">Список приглашений</a></li>
                                <li class="breadcrumb-item active">Приглашение</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container">
                    <div class="row justify-content-center">
                        @if($invite)
                                <div class="col-md-8 col-xl-8 text-center">
                                    <!-- Simple card -->
                                    <div class="card">
                                        <img class="card-img-top img-fluid" src="{{asset("/images/quiz.jpg")}}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title font-size-18 mt-0">
                                                {{$invite->title}}
                                            </h4>
                                            <hr>
                                            <h3 class="card-title font-size-16 mt-0">
                                                {{$soloviev_quiz->title}}
                                            </h3>
                                            <p class="card-text">
                                                {!! $soloviev_quiz->description !!}
                                            </p>
                                            <hr>
                                            <p class="card-text">Тип теста: {{$invite->type->title}}</p>
                                            <p class="card-text">Отдел: {{$invite->department->title}}</p>
                                            <p class="card-text">Сотрудник(и): {{$invite->user ? $invite->user->name : "Все сотрудники отдела"}}</p>
                                            <p class="card-text">Начало: {{\Carbon\Carbon::parse($invite->start)->diffForHumans()}}</p>
                                            <p class="card-text">Окончание: {{\Carbon\Carbon::parse($invite->end)->diffForHumans()}}</p>
                                            <a href="{{$invite->type_id == 1 ? route('solovievPass',$invite->id) : ""}}" class="btn btn-primary waves-effect waves-light">Сдать тест!</a>
                                        </div>
                                    </div>

                                </div><!-- end col -->
                        @else
                            <h4 class="text-danger">Теста нет</h4>
                        @endif
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
