@extends('layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Настройки</h4>
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
                                    <form action="{{route('adminUpdateProfile', Auth::id())}}" method="post" id="js-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel">Обновить профиль</h5>
                                        </div>
                                        <div class="modal-body">
                                            <label>ФИО</label>
                                            <input type="text" class="form-control" name="name" placeholder="ФИО" value="{{Auth::user()->name}}">
                                            <input type="hidden" name="role_id" value="1">
                                            <input type="hidden" name="position" value="{{Auth::user()->position}}">
                                            <input type="hidden" name="phone" value="{{Auth::user()->phone}}">
                                            <label class="mt-3">Email</label>
                                            <input type="email" readonly name="email" class="form-control" value="{{Auth::user()->email}}">
                                            <label class="mt-3">Пароль</label>
                                            <input type="password" class="form-control" name="password" placeholder="Пароль">
                                            <label class="mt-3">Фото (необязательно)</label>
                                            <input type="file" class="form-control" name="img">
                                            <img class="rounded-circle header-profile-user" src="{{Auth::user()->img}}">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('adminHome')}}" class="btn btn-secondary waves-effect">Назад</a>
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
