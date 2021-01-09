@extends('layout')
@push('styles')
    <style>
        .profile-banner {
            width: 100%;
            height: 330px;
            background-position: center center;
            background-size: cover;
            position: relative;
            background-color: #252932;
            border-bottom: 4px solid #fff;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: white;
        }
        .avatar-container {
            height: 150px;
            text-align: center;
            margin: 0 auto;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

    </style>
@endpush
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container bootdey">
                                        <div class="content-page">
                                            <div class="profile-banner"
                                                 style="background:url('/images/bg1.2.png');">
                                                <div class="col-sm-3 mt-4 avatar-container">
                                                    <img src="{{$user->img}}" class="mt-3 img-circle profile-avatar"
                                                         alt="User avatar">
                                                </div>
                                                <h2 class="mt-3 text-white">{{$user->name}}</h2>
                                                <span>Компания - {{$user->department->company->title}}</span><br>
                                                <span>Департамент - {{$user->department->title}}</span><br>
                                                <span>Должность - {{$user->position}}</span><br>
                                                <span>Телефон - {{$user->phone}}</span><br>
                                                <span>Email - {{$user->email}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-pills row justify-content-around w-75 m-auto" role="tablist">
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-selected="true">
                                                        <i class="fas fa-home mr-1"></i> <span class="d-none d-md-inline-block">Результаты рестов</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-selected="false">
                                                        <i class="fas fa-question mr-1"></i> <span class="d-none d-md-inline-block">Предстоящие тесты</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content p-3 w-75 m-auto">
                                                <div class="tab-pane active" id="home-1" role="tabpanel">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>Тест</th>
                                                                <th>Тип теста</th>
                                                                <th>Результат</th>
                                                                <th>Дата сдачи</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if (($user->invites->count() > 0))
                                                                @if ($user->results->count() > 0)
                                                                    @foreach($user->results as $item)
                                                                        @if ($item->status)
                                                                            <tr>
                                                                                <td>{{$item->invite->title}}</td>
                                                                                <td>{{$item->invite->type->title}}</td>
                                                                                <td><a href="@switch($item->invite->type_id)
                                                                                    @case(1)
                                                                                    {{route('soloviev-show',$item->id)}}
                                                                                    @break
                                                                                    @case(2)
                                                                                    {{route('belbin-show',$item->id)}}
                                                                                    @break
                                                                                    @endswitch" class="btn btn-primary btn-sm waves-effect waves-light">Посмотреть</a></td>
                                                                                <td>{{$item->pass_time}}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @else
                                                                <tr>
                                                                    <td>У данного сотрудника результатов пока нет</td>
                                                                </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profile-1" role="tabpanel">
                                                    <p class="mb-0">
                                                    <table class="table mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>Тест</th>
                                                            <th>Тип теста</th>
                                                            <th>Начало</th>
                                                            <th>Конец</th>
                                                            <th>Статус</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if (($user->invites->count() > 0))
                                                            @foreach($user->invites as $item)
                                                                @if (\Illuminate\Support\Carbon::now()->format('Y.m.d') <= date('Y.m.d', strtotime($item->end)))

                                                                    <tr>
                                                                        <td>{{$item->title}}</td>
                                                                        <td>{{$item->type->title}}</td>
                                                                        <td>{{date('d.m.y', strtotime($item->start))}}</td>
                                                                        <td>{{date('d.m.y', strtotime($item->end))}}</td>
                                                                        <td>
                                                                            @if ($item->results->count() > 0)
                                                                                @foreach($item->results as $result)
                                                                                    @if ($result->status)
                                                                                        <div class="text-success">Завершен</div>
                                                                                    @else
                                                                                        <div class="text-danger">Не сдал</div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <div class="text-warning">Не завершен</div>
                                                                            @endif
                                                                        </td>
                                                                    </tr>

                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td>Предстоящих тестов у данного сотрудника нет</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div>
                    <!-- end container-fluid -->
                    <!-- end row -->
                    @if($news)
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>Актуальные новости</h2>
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
                                    <a href="{{route("news-show",$news->id)}}" class="btn btn-primary">Читать</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{route("employee-news")}}" class="btn btn-primary">Все новости</a>

                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    @endif
                </div>
            </div>
        </div>

@endsection


