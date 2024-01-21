@extends("layout")
@section("content")
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список обращений в техподдержку</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white my-3 p-3 vh-100">
                <livewire:admin.ticket-table/>
            </div>
            <!-- end page title end breadcrumb -->

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
