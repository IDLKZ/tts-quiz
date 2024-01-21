@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl text-black">
                            Канбан Доска-Задач
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2">
                        <div class="float-right d-block">
                            <div class="dropdown">
                                <a href="{{route("employee-task-create")}}" class="btn bg-warning text-white btn-rounded dropdown-toggle">
                                    <i class="mdi mdi mdi-plus-thick  mr-1"></i> Создать задачи
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->

            <!-- end row -->

            <!-- end page title end breadcrumb -->
            <livewire:employee.task.index/>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
