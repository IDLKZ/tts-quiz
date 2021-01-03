@extends("layout")


@push("styles")
    <link href="/css/selectize.css" rel="stylesheet" type="text/css" />
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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form id="js-form" action="{{route("invite.store")}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Компания</label>
                                            <div class="col-md-10">
                                                <select name="company_id" id="select-company" class="selectize">
                                                    @foreach($companies as $company)
                                                        <option value="{{$company->id}}">{{$company->title}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Отдел</label>
                                            <div class="col-md-10">
                                                <select name="department_id" id="select-company" class="selectize">
                                                    <option>Не выбрано</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Сотрудник</label>
                                            <div class="col-md-10">
                                                <select name="user_id" id="select-company" class="selectize">
                                                    <option>Все сотрудники</option>
                                                </select>
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
    <script src="/js/selectize.min.js"></script>
    @livewireScripts
    <script>
        $(document).ready(function (){
            $('#select-company').selectize({
                create: false,
                sortField: 'text',


            });

        })
    </script>


@endpush

