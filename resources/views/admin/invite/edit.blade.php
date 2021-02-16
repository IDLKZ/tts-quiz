@extends("layout")


@push("styles")
    @livewireStyles
@endpush

@section("content")

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Редактировать приглашения</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("invite.index")}}">Приглашение</a></li>
                                <li class="breadcrumb-item active">Редактировать Приглашения</li>
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
                                    <h4 class="header-title">Здесь вы можете изменить приглашения</h4>
                                    <p class="card-title-desc">У каждой компании имеются свои приглашения</p>

                                    <form action="{{route('invite.update', $invite->id)}}" method="post" id="js-form">
                                        @method('put')
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Наименование</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="title" type="text" value="{{$invite->title}}" id="example-text-input">
                                                @error('title') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Компания</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" disabled value="{{$invite->department->company->title}}">
                                                <input type="hidden" name="company_id" value="{{$invite->department->company->id}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Отдел</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" disabled value="{{$invite->department->title}}">
                                                <input type="hidden" name="department_id" value="{{$invite->department_id}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Сотрудник</label>
                                            <div class="col-md-10">
                                                @if($invite->user)
                                                <input type="text" class="form-control" disabled value="{{$invite->user->name}}">
                                                <input type="hidden" name="user_id" value="{{$invite->user_id}}">
                                                @else
                                                    <input type="text" class="form-control" disabled value="Все сотрудники отдела">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Тип теста</label>
                                            <div class="col-md-10">
                                                <select name="type_id" class="form-control">
                                                    <option selected value="{{$invite->type_id}}">{{$invite->type->title}}</option>
                                                    @foreach($types as $type)
                                                        <option value="{{$type->id}}" class="{{$invite->type_id == $type->id ? 'd-none' : ''}}">{{$type->title}}</option>
                                                    @endforeach
                                                </select>
                                                @error('type_id') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-md-2 col-form-label">Начало</label>
                                            <div class="col-md-10">
                                                <input name="start" class="form-control" value="{{date('Y-m-d', strtotime($invite->start))}}" type="date" id="example-date-input">
                                                @error('start') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-md-2 col-form-label">Конец</label>
                                            <div class="col-md-10">
                                                <input name="end" class="form-control" value="{{date('Y-m-d', strtotime($invite->end))}}" type="date" id="example-date-input">
                                                @error('end') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-info">Обновить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
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
@push("scripts")
    @livewireScripts
@endpush

