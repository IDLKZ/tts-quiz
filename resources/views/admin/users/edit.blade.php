@extends('layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Редактировать</h4>
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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{route('user.update', $user->id)}}" method="post" id="js-form" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel">Редактировать сотрудника</h5>
                                        </div>
                                        <div class="modal-body">
                                            <label for="role">Роль:</label>
                                            <select name="role_id" id="role" class="form-control">
                                                <option value="1">Админ</option>
                                                <option value="2" selected>Сотрудник</option>
                                            </select>
                                            <input type="text" class="form-control mt-3" name="name" placeholder="ФИО" value="{{$user->name}}">
                                            <select name="department_id" class="form-control mt-3">
                                                <option value="{{$user->department_id}}" selected>{{$user->department->title}} ({{$user->department->company->title}})</option>
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}" class="{{$user->department_id == $department->id ? 'd-none' : ''}}">{{$department->title}} ({{$department->company->title}})</option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="form-control mt-3" name="position" placeholder="Должность" value="{{$user->position}}">
                                            <input type="text" class="form-control mt-3" name="phone" placeholder="Номер телефона" value="{{$user->phone}}">
                                            <input type="email" class="form-control mt-3" name="email" placeholder="Email" value="{{$user->email}}">
                                            <input type="password" class="form-control mt-3" name="password" placeholder="Пароль">
                                            <label class="mt-3">Фото сотрудника (необязательно)</label>
                                            <input type="file" class="form-control" name="img">
                                            <img class="rounded-circle header-profile-user" src="{{$user->img}}">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('user.index')}}" class="btn btn-secondary waves-effect">Назад</a>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Обновить</button>
                                        </div>
                                    </form>

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

