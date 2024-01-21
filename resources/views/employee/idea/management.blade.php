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
                            Список идей
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список идей.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2">
                        <div class="float-right d-block">
                            <div class="dropdown">
                                <a href="{{route("employee-idea.create")}}" class="btn btn-warning text-white btn-rounded dropdown-toggle">
                                    <i class="mdi mdi mdi-plus-thick  mr-1"></i> Предложить идею
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 p-3 bg-white rounded-lg">
                        <livewire:employee.idea-table/>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection


