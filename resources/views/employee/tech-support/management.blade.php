@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                            Все обращения в техническую поддержку
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список обращений.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->
            <livewire:employee.ticket.management/>
            <!-- end row -->
            <!-- end page title end breadcrumb -->


            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
