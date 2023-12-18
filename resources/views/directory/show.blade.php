@extends($layout)
@push("styles")
    @livewireStyles
@endpush
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Справочник</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Главная</a></li>
                                <li class="breadcrumb-item active">Справочник</li>
                            </ol>
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
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="text-center mt-4">
                                                <h4>Справочник</h4>
                                                <p class="text-muted">Здесь вы можете посмотреть информацию сотрудников</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-12">
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
                                                                @employee
                                                                <th>Номер телефона</th>
                                                                @endemployee
                                                                @admin
                                                                <th>Действие</th>
                                                                @endadmin
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($users as $user)
                                                                <tr>
                                                                    <th scope="row">{{$loop->iteration}}</th>
                                                                    <td>{{$user->name}}<br><span class="text-muted">{{$user->email}}</span></td>
                                                                    <td>{{$user->department->company->title}}</td>
                                                                    <td>{{$user->department->title}}</td>
                                                                    <td>{{$user->position}}</td>
                                                                    <td>{{$user->candidate == 1 ? "Кандидат" : "Не кандидат"}}</td>
                                                                    <td><img class="rounded-circle header-profile-user" src="{{$user->img}}"></td>
                                                                    @admin
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
                                                                    @endadmin
                                                                    @employee
                                                                    <td>{{$user->phone}}</td>
                                                                    @endemployee
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
@push("scripts")
    @livewireScripts
@endpush

