@extends("layout")


@push("styles")
    <link href="/css/selectize.css" rel="stylesheet" type="text/css" />
    <link href="/css/dropzone.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
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
                            <h4 class="page-title mb-1">Изменить отдел</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("department.index")}}">Отделы</a></li>
                                <li class="breadcrumb-item active">Изменить Отдел</li>
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

                                    <h4 class="header-title">Здесь вы можете изменить отдел</h4>
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
                                    <form id="js-form" action="{{route("department.update",$department->id)}}" method="post" enctype="multipart/form-data">
                                        @method("PUT")
                                        @csrf
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Компания</label>
                                            <div class="col-md-10">
                                                <select name="company_id" id="select-company" class="selectize">
                                                    <option value="{{$department->company_id}}">{{$department->company->title}}</option>
                                                    @foreach($companies as $company)
                                                        @if($company->id != $department->company_id)
                                                        <option value="{{$company->id}}">{{$company->title}}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Наименование отдела</label>
                                            <div class="col-md-10">
                                                <input class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{$department->title}}" id="example-text-input" }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Описание отдела</label>
                                            <div class="col-md-10">
                                                <textarea id="editor" name="description">
                                                    {!! $department->description !!}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Логотип отдела</label>
                                            <img src="{{$department->logo}}" width="120" height="120">
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div id="upload-demo"></div>
                                        </div>
                                        <div class="col-md-4" style="padding:5%;">
                                            <strong>Выберите логотип:</strong>
                                            <input type="file" id="image" name="logo" accept="image/jpeg,image/png,image/gif">
                                            <button class="btn btn-primary btn-block upload-image" style="margin-top:2%" >Обрезать фото</button>
                                        </div>
                                        <input hidden type="text" id="image1" name="image" value="">
                                        <div class="text-right">
                                            <button id="submit" type="submit" class="btn btn-info" >Отправить</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

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

                //Crop Start
            $("#image1").val("");

            var resize = $('#upload-demo').croppie({
                enableExif: true,
                enableOrientation: true,
                viewport: { // Default { width: 100, height: 100, type: 'square' }
                    width: 200,
                    height: 200,
                    type: 'circle' //square
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });


            $('#image').on('change', function (e) {
                $("#submit").attr("disabled",true);
                var reader = new FileReader();
                reader.onload = function (e) {
                    resize.croppie('bind',{
                        url: e.target.result
                    }).then(function(){
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('.upload-image').on('click', function (ev) {
                ev.preventDefault();
                $("#image1").val("");
                resize.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (img) {
                    $("#image1").val(img);
                    $("#submit").attr("disabled",false);

                });
            });

        })

    </script>
@endpush

