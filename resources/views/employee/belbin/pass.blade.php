@extends('layout-employee')
@push("styles")
    @livewireStyles
    <style>
        .belbin-blog{
            font-size: 16px;
            font-weight: 600;
            min-height: 100px;
            text-align: center;
            border:1px solid;
            border-radius: 30px;
            padding: 10px;
            margin: 10px;
        }
        .nav-item{
            margin-top: 2px;
            border: 1px solid;
            border-radius: .25rem;
        }
        .nav-item:hover{
            cursor: pointer;
        }
        .checked{
            background-color: #0c5460;
        }
    </style>
@endpush
@section('content')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Пройти тест</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Главная</a></li>
                                <li class="breadcrumb-item active">Тест Белбина</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->



            <livewire:belbin-quiz :invite="$invite"></livewire:belbin-quiz>







        </div>
        <!-- End Page-content -->



    </div>
    <!-- end main content-->

@endsection

@push("scripts")
    @livewireScripts
@endpush
