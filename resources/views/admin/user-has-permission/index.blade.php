@extends("layout")
@section("content")
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Рабочий календарь</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Рабочий Календарь</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{route("user-has-permission.create")}}" class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi mdi-plus-thick  mr-1"></i> Создать Разрешение для пользователя
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <livewire:admin.user-has-permission-table/>

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
