@extends('layout')

@push("styles")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Добавить компанию</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel">Создать новую компанию</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Наименование</label>
                                            <input type="text" class="form-control" name="title" placeholder="наименование">
                                            <label class="mt-3">Описание (необязательно)</label>
                                            <textarea name="description" id="editor"></textarea>
                                            <div class="col-md-4 text-center">
                                                <div id="upload-demo"></div>
                                            </div>
                                            <div class="col-md-4" style="padding:5%;">
                                                <strong>Выберите логотип:</strong>
                                                <input type="file" id="image" name="logo" accept="image/jpeg,image/png,image/gif">
                                                <button class="btn btn-primary btn-block upload-image" style="margin-top:2%" >Обрезать фото</button>
                                            </div>
                                            <input hidden type="text" id="image1" name="image" value="">

                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('company.index')}}" class="btn btn-secondary waves-effect">Назад</a>
                                            <button id="submit" type="submit" class="btn btn-primary waves-effect waves-light">Сохранить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
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

    </script>
@endpush
