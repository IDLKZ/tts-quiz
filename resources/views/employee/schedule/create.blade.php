@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div>
            <div class="container my-2">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl text-black">
                            Создать событие на рабочем графике
                        </p>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->

            <!-- end row -->

            <!-- end page title end breadcrumb -->

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->
        <livewire:employee.schedule.create/>
    </div>
    <!-- end main content-->

@endsection
