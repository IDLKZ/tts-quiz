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
                            <h4 class="page-title mb-1">Список сотрудников</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-rounded dropdown-toggle" type="button" data-toggle="modal" data-target="#myModal">
                                        <i class="mdi mdi-plus mr-1"></i> Добавить
                                    </button>
                                    <a href="{{route("user-excel")}}" class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi-excel mr-1"></i> Добавить Excel
                                    </a>
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
                                                        <div class="form-check mt-3">
                                                            <input type="checkbox" name="candidate" class="form-check-input" id="exampleCheck1">
                                                            <label class="form-check-label" for="exampleCheck1">Сотрудник является кандидатом (кандидаты не могут видеть свои результаты и новости)</label>
                                                        </div>
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
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Закрыть</button>
                                                        <button id="submit" type="submit" class="btn btn-primary waves-effect waves-light">Сохранить</button>
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
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Имя</th>
                                                <th>Компания</th>
                                                <th>Департамент</th>
                                                <th>Должность</th>
                                                <th>Кандидат</th>
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
                                                    <td>{{$user->candidate == 1 ? "Кандидат" : "Не кандидат"}}</td>
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
