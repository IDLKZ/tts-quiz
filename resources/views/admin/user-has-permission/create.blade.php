@extends("layout")



@section("content")

    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Создать Разрешения для пользователя</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("user-has-permission.index")}}">Разрешения для пользователя</a></li>
                                <li class="breadcrumb-item active">Создать Разрешение для пользователя</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container">
                    <livewire:admin.user-has-permission.create/>
                    <!-- end col -->
                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->



    </div>
@endsection
