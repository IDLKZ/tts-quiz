@extends('layout')
@push("styles")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
@endpush
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
                                            <img class="rounded-circle header-profile-user" width="180" height="180" src="{{$user->img}}">
                                            <div class="col-md-4 text-center mt-5">
                                                <div id="upload-demo"></div>
                                            </div>
                                            <div class="col-md-4" style="padding:5%;">
                                                <strong>Выберите фото(Необязательно):</strong>
                                                <input type="file" id="image" name="img" accept="image/jpeg,image/png,image/gif">
                                                <button class="btn btn-primary btn-block upload-image" style="margin-top:2%" >Обрезать фото</button>
                                            </div>
                                            <input hidden type="text" id="image1" name="image" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('user.index')}}" class="btn btn-secondary waves-effect">Назад</a>
                                            <button id="submit" type="submit" class="btn btn-primary waves-effect waves-light">Обновить</button>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script>



        //Crop Start
        $("#image1").val("");

        var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: { // Default { width: 100, height: 100, type: 'square' }
                width: 200,
                height: 200,
                type: 'circle' //square
            },
            boundary: {
                width: 300,
                height: 300
            }
        });


        $('#image').on('change', function (e) {
            $("#submit").attr("disabled",true);
            var reader = new FileReader();
            reader.onload = function (e) {
                resize.croppie('bind',{
                    url: e.target.result
                }).then(function(){
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.upload-image').on('click', function (ev) {
            ev.preventDefault();
            $("#image1").val("");
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (img) {
                $("#image1").val(img);
                $("#submit").attr("disabled",false);

            });
        });

    </script>
@endpush
