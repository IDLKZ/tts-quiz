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
                            Форумы
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                           Список форумов
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2 text-right">
                        <a href="{{route("forumCreate")}}" class="btn btn-warning text-white px-4 py-2">
                            Создать форум
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">

                <livewire:employee.forum.index/>

            </div>
            <!-- End Page-content -->
        </div>
    </div>
    <!-- end main content-->

@endsection
