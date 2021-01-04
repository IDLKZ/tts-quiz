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
                                    @livewire('admin.invite.edit',['invite' => $invite])
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
    <script>
        $('.getDepart').click(function () {
            $('#deleteDepart').remove();
            $('#deleteUser').remove();
        })
        $('.getUser').click(function () {
            $('#deleteUser').remove();
        })
    </script>
@endpush

