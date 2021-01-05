@extends('layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список сотрудников</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-rounded dropdown-toggle" type="button" data-toggle="modal" data-target="#myModal">
                                        <i class="mdi mdi-plus mr-1"></i> Добавить
                                    </button>
                                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('user.store')}}" method="post" id="js-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Добавить сотрудника</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="role">Роль:</label>
                                                        <select name="role_id" id="role" class="form-control">
                                                            <option value="1">Админ</option>
                                                            <option value="2" selected>Сотрудник</option>
                                                        </select>
                                                        <input type="text" class="form-control mt-3" name="name" placeholder="ФИО">
                                                        <select name="department_id" class="form-control mt-3">
                                                            @foreach($departments as $department)
                                                                <option value="{{$department->id}}">{{$department->title}} ({{$department->company->title}})</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="form-control mt-3" name="position" placeholder="Должность">
                                                        <input type="text" class="form-control mt-3" name="phone" placeholder="Номер телефона">
                                                        <input type="email" class="form-control mt-3" name="email" placeholder="Email">
                                                        <input type="password" class="form-control mt-3" name="password" placeholder="Пароль">
                                                        <label class="mt-3">Фото сотрудника (необязательно)</label>
                                                        <input type="file" class="form-control" name="img">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Закрыть</button>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Сохранить</button>
                                                    </div>
                                                </form>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <h4 class="header-title">Сотрудники</h4>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Имя</th>
                                                <th>Компания</th>
                                                <th>Департамент</th>
                                                <th>Должность</th>
                                                <th>Фото</th>
                                                <th>Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->department->company->title}}</td>
                                                    <td>{{$user->department->title}}</td>
                                                    <td>{{$user->position}}</td>
                                                    <td><img class="rounded-circle header-profile-user" src="{{$user->img}}"></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{route('user.show', $user->id)}}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            <a href="{{route('user.edit', $user->id)}}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <form action="{{route('user.destroy', $user->id)}}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                            <button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return (prompt('Вы уверены? Напишите 0000 чтобы удалить') == '0000' ? true : false)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                                <i class="mdi mdi-trash-can"></i>
                                                            </button>
                                                            </form>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {!! $users->links() !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->
            </div>
        </div>
    </div>

@endsection

