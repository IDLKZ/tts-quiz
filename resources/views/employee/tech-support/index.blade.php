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
                            Мои обращение в техническую поддержку
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список обращений.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2">
                        <div class="float-right d-block">
                            <div class="dropdown">
                                <a href="{{route("tech-support-ticket-create")}}" class="btn btn-light btn-rounded dropdown-toggle">
                                    <i class="mdi mdi mdi-plus-thick  mr-1"></i> Создать тикет
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->
                <livewire:employee.ticket.index/>
            <!-- end row -->
            <!-- end page title end breadcrumb -->


            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
