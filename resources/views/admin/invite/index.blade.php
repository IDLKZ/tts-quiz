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
                            <h4 class="page-title mb-1">Список Приглашений</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Список Приглашений</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{route("invite.create")}}" class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi mdi-plus-thick  mr-1"></i> Добавить
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

                                    <h4 class="header-title">Приглашения</h4>
                                    <p class="card-title-desc">Здесь вы можете увидеть список текущих приглашений.</p>
                                    @if($invites->isNotEmpty())
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="2">Отдел</th>
                                                        <th data-priority="3">Сотрудник</th>
                                                        <th data-priority="4">Тип теста</th>
                                                        <th data-priority="4">Наименование</th>
                                                        <th data-priority="4">Начало теста</th>
                                                        <th data-priority="4">Конец теста</th>
                                                        <th data-priority="4">Статус</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($invites as $invite)
                                                        <tr>
                                                            <td>{{$invite->department->title}}</td>
                                                            <td>{{$invite->user_id ? $invite->user->name : "Все сотрудники отдела"}}</td>
                                                            <td>{{$invite->type->title}}</td>
                                                            <td>{{$invite->title}}</td>
                                                            <td>{{$invite->start}}</td>
                                                            <td>{{$invite->end}}</td>
                                                            <td>{{$invite->status == 1 ? "Заверешен" : "Не завершен"}}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="{{route("invite.show",$invite->id)}}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                                                        <i class="mdi mdi-eye"></i>
                                                                    </a>
                                                                    <a href="{{route("invite.edit",$invite->id)}}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </a>
                                                                    <form action="{{route('invite.destroy',$invite->id)}}" method="post">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return (prompt('Вы уверены? Напишите 0000 чтобы удалить', '0000') == '0000' ? true : false)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                                            <i class="mdi mdi-trash-can"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                {{$invites->links()}}
                                            </div>

                                        </div>
                                    @else
                                        <p class="font-size-16 text-danger">Приглашений еще нет</p>
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

