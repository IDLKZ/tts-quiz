@extends("layout")


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
                            <h4 class="page-title mb-1">Поиск сотрудника</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Поиск сотрудника по имени</li>
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

                                    <h4 class="header-title">Здесь вы найти сотрудника</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form id="js-form" action="{{route("result-search")}}" method="get">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Введите имя сотрудника</label>
                                            <div class="col-md-10">
                                                <input class="form-control  @error('search') is-invalid @enderror" name="search" type="text" value="{{old("search")}}" id="example-text-input">
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-info bg-indigo-400 text-white ">Поиск</button>

                                        </div>
                                    </form>

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


