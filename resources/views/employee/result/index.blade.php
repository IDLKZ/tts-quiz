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
                            <h4 class="page-title mb-1">Результаты</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('employeeHome')}}">Главная</a></li>
                                <li class="breadcrumb-item active">Результаты</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            @if($results->isNotEmpty())
                            <div class="timeline" dir="ltr">
                                <div class="timeline-item timeline-left">
                                    <div class="timeline-block">
                                        <div class="time-show-btn mt-0">
                                            <a href="javascript:void (0)" class="btn btn-info w-lg">Результаты</a>
                                        </div>
                                    </div>
                                </div>
                                 @foreach($results as $result)
                                <div class="timeline-item @if($loop->iteration%2 != 0) timeline-left  @else @endif">
                                    <div class="timeline-block">
                                        <div class="timeline-box card">
                                            <div class="card-body">
                                                <div class="timeline-icon icons-md">
                                                    <i class="uim uim-layer-group"></i>
                                                </div>
                                                <div class="d-inline-block py-1 px-3 bg-primary text-white badge-pill">
                                                    {{$result->invite->title}}
                                                </div>
                                                <p class="mt-3 mb-2">{{\Carbon\Carbon::parse($result->pass_time)->diffForHumans()}}</p>
                                                <p class="mt-3 mb-2">Сотрудник: {{$result->user->name}}</p>
                                                <p class="mt-3 mb-2">Должность в момент сдачи: {{$result->position}}</p>
                                                @if($result->job)
                                                <p class="mt-3 mb-2">Должность для теста: {{$result->job->title}}</p>
                                                @endif
                                                @if($result->invite->visible == 1)
                                                <a href="
                                                @switch($result->invite->type_id)
                                                @case(1)
                                                {{route('soloviev-show',$result->id)}}
                                                    @break
                                                @case(2)
                                                {{route('belbin-show',$result->id)}}
                                                    @break
                                                @endswitch
                                                " class="btn btn-success rounded-rounded text-white">Детали</a>
                                                 @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{$results->links()}}

                            </div>
                            @else
                            <h5>Пока результатов нет</h5>
                            @endif
                        </div>
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
