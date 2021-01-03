@extends("layout")


@push("styles")
    <link href="/css/selectize.css" rel="stylesheet" type="text/css" />
    <link href="/css/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

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
                            <h4 class="page-title mb-1">Создать отдел</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("department.index")}}">Отделы</a></li>
                                <li class="breadcrumb-item active">Создать Отдел</li>
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

                                    <h4 class="header-title">Здесь вы можете создать отдел</h4>
                                    <p class="card-title-desc">У каждой компании имеются свои отделы</p>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form id="js-form" action="{{route("department.store")}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Компания</label>
                                            <div class="col-md-10">
                                                <select name="company_id" id="select-company" class="selectize">
                                                    @foreach($companies as $company)
                                                        <option value="{{$company->id}}">{{$company->title}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Наименование отдела</label>
                                            <div class="col-md-10">
                                                <input class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{old("title")}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Описание отдела</label>
                                            <div class="col-md-10">
                                                <textarea id="editor" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Логотип отдела</label>
                                            <div class="col-md-10">
                                                <input type="file" name="logo">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-info">Отправить</button>

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
@push("scripts")
   <script src="/js/selectize.min.js"></script>
   <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
   <script src="/js/dropzone.min.js"></script>

    <script>
        $(document).ready(function (){
            $('#select-company').selectize({
                create: true,
                sortField: 'text'
            });
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );

        })

    </script>
@endpush
