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
                            Опросник
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            {{$questionnaire->title}}
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2 text-right">
                        <a href="{{route("list-questionnaires")}}" class="btn btn-warning text-white px-4 py-2">
                            Назад в Опросники
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 my-2 card p-4 rounded-xl">
                        <livewire:employee.questionnaire.pass :questionnaire="$questionnaire" :questions="$questions"/>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end main content-->

@endsection
