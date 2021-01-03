@extends("layout")



@section("content")

    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Отдел {{$department->title}}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("department.index")}}">Отделы</a></li>
                                <li class="breadcrumb-item active">Отдел {{$department->title}}</li>
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

                                    <h4 class="header-title">Отделы</h4>
                                    <p class="card-title-desc">Здесь вы можете увидеть список сотрудников текущего отдела.</p>
                                    @if($users->isNotEmpty())
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Изображение</th>
                                                        <th data-priority="1">ФИО</th>
                                                        <th data-priority="1">Отдел</th>
                                                        <th data-priority="2">Почта</th>
                                                        <th data-priority="3">Телефон</th>
                                                        <th data-priority="4">Действия</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td><img class="rounded-circle header-profile-user" src="{{$user->img}}" alt="{{$user->name}}"></td>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->department->title}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>{{$user->phone}}</td>

                                                            <td>
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <a href="{{route("user.edit",$user->id)}}" class="btn btn-primary"><i class="mdi mdi-pen"></i> </a>
                                                                    <a href="{{route("user.show",$user->id)}}" class="btn btn-success"><i class="mdi mdi-eye"></i></a>
                                                                    <form action="{{route('user.destroy',$user->id)}}" method="post">
                                                                        @csrf
                                                                        @method("delete")
                                                                        <button onclick="return (prompt('Вы уверены? Напишите 0000 чтобы удалить') == '0000' ? true : false)" type="submit" class="btn btn-danger"><i class="mdi mdi-delete"></i> </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                {{$users->links()}}
                                            </div>

                                        </div>
                                    @else
                                        <p class="font-size-16 text-danger">Пользователей еще нет</p>
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
