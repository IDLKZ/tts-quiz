@extends("layout")
@section("content")


    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список Результатов</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Список Результатов</li>
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

                                    <h4 class="header-title">Результаты</h4>
                                    <p class="card-title-desc">Здесь вы можете увидеть список текущих результатов по тестам.</p>
                                    @if($results->isNotEmpty())
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="2">Сотрудник</th>
                                                        <th data-priority="3">Приглашение</th>
                                                        <th data-priority="4">Тип теста</th>
                                                        <th data-priority="4">Работа</th>
                                                        <th data-priority="4">Позиция</th>
                                                        <th data-priority="4">Время сдачи</th>
                                                        <th data-priority="4">Действия</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($results as $result)
                                                        <tr>
                                                            <td>{{$result->user->name}}</td>
                                                            <td>{{$result->invite->title}}</td>
                                                            <td>{{$result->invite->type->title}}</td>
                                                            <td>{{$result->job !== null ? $result->job->title : ""}}</td>
                                                            <td>{{$result->position}}</td>
                                                            <td>{{$result->pass_time}}</td>
                                                            <td><a href="@switch($result->invite->type_id)
                                                                @case(1)
                                                                {{route('admin-soloview-show', ['userId' => $result->user_id, 'id' => $result->id])}}
                                                                @break
                                                                @case(2)
                                                                {{route('admin-belbin-show', ['userId' => $result->user_id, 'id' => $result->id])}}
                                                                @break
                                                                @endswitch" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-eye"></i> </a></td>

                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                {{$results->links()}}
                                            </div>

                                        </div>
                                    @else
                                        <p class="font-size-16 text-danger">Результатов еще нет</p>
                                    @endif
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->

@endsection
