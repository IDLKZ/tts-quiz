@extends("layout")



@section("content")

    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Изменить видеоурок {{$lesson->title}}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("lesson.index")}}">Видеоуроки</a></li>
                                <li class="breadcrumb-item active">Изменить Курс {{$lesson->title}}</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container">
                        <livewire:admin.lesson.edit :lesson="$lesson"/>
                        <!-- end col -->

                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->



    </div>
@endsection
