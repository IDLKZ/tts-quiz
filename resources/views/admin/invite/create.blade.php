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
                            <h4 class="page-title mb-1">Создать приглашение</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("invite.index")}}">Приглашение</a></li>
                                <li class="breadcrumb-item active">Создать Приглашение</li>
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
                                    <h4 class="header-title">Здесь вы можете создать приглашения</h4>
                                    <p class="card-title-desc">У каждой компании имеются свои приглашения</p>
{{--                                    @livewire('admin.invite.create')--}}
                                    <form action="{{route('invite.store')}}" method="post" id="js-form">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Наименование</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="title" type="text" value="{{old("title")}}" id="example-text-input">
                                                @error('title') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Компания</label>
                                            <div class="col-md-10">
                                                <livewire:admin.invite.select.company-select
                                                    name="company_id"
                                                    placeholder="Выберите компанию"
                                                />
                                                @error('company_id') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Отдел</label>
                                            <div class="col-md-10">
                                                <livewire:admin.invite.select.department-select
                                                    name="department_id"
                                                    placeholder="Выберите отдел"
                                                    :depends-on="['company_id']"/>
                                                @error('department_id') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Сотрудник</label>
                                            <div class="col-md-10">
                                                <livewire:admin.invite.select.employee-select
                                                    name="user_id"
                                                    placeholder="Выберите сотрудника"
                                                    :depends-on="['department_id']"/>
                                                @error('user_id') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Тип теста</label>
                                            <div class="col-md-10">
                                                <select name="type_id" class="form-control">
                                                    <option>Не выбрано</option>
                                                    @foreach($types as $type)
                                                        <option value="{{$type->id}}">{{$type->title}}</option>
                                                    @endforeach
                                                </select>
                                                @error('type_id') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-md-2 col-form-label">Начало</label>
                                            <div class="col-md-10">
                                                <input name="start" class="form-control" value="{{\Illuminate\Support\Carbon::now()->format('Y.m.d')}}" type="date" id="example-date-input">
                                                @error('start') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-md-2 col-form-label">Конец</label>
                                            <div class="col-md-10">
                                                <input name="end" class="form-control" type="date" id="example-date-input">
                                                @error('end') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-info">Отправить</button>

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

