@extends("layout")


@push("styles")
    <style>

    </style>
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
                            <h4 class="page-title mb-1">Создать новость</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("news.index")}}">Новость</a></li>
                                <li class="breadcrumb-item active">Создать Новость</li>
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

                                    <h4 class="header-title">Здесь вы можете создать новость</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form id="js-form" action="{{route("news.update",$news->id)}}" method="post" enctype="multipart/form-data">
                                        @method("PUT")
                                        @csrf

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Заголовок новости</label>
                                            <div class="col-md-10">
                                                <input class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{$news->title}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Подзаголовок новости</label>
                                            <div class="col-md-10">
                                                <input class="form-control  @error('title') is-invalid @enderror" name="subtitle" type="text" value="{{$news->subtitle}}" id="example-text-input">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Описание новости</label>
                                            <div class="col-md-10">
                                                <textarea id="editor" name="description">
                                                    {!! $news->description !!}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input type="checkbox" name="is_main" class="form-check-input" id="is_main" checked="{{$news->is_main === true ? true : false}}">
                                            <label class="form-check-label" for="is_main">На главной</label>
                                        </div>
                                        <input type="hidden" id="deletedGalleryId" name="deletedGalleryId">
                                        @if($news->galleries)
                                            <div class="form-group row">
                                                @foreach($news->galleries as $gallery)
                                                    <div class="relative flex justify-center items-center">
                                                        <i id="xmark{{$gallery->id}}" class="fas fa-times text-red-500 absolute text-2xl z-20 hidden"></i>
                                                        <img data-id="{{$gallery->id}}" src="{{$gallery->getFile("image_url")}}" class="image-gallery my-2 px-3 cursor-pointer relative" style="max-width: 200px;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <hr/>
                                        <div class="form-group row my-2">
                                            <label for="example-text-input" class="col-md-12 col-form-label">Галерея новости</label>
                                            <div class="col-md-12">
                                                <input type="file" multiple name="images[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <img src="{{$news->img}}" class="my-2 px-3 block" style="max-width: 200px;">
                                            <label for="example-text-input" class="col-md-12 col-form-label">Изображение новости</label>
                                            <div class="col-md-12">
                                                <input type="file" name="img">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-info">Изменить</button>

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
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function (){
            $("#deletedGalleryId").val(null);
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
            let deletedFile = [];
            $(".image-gallery").click(function () {
                let galleryId = $(this).attr("data-id");
                const index = deletedFile.indexOf(galleryId);
                if (index > -1) {
                    deletedFile.splice(index, 1);
                    $(this).removeClass("brightness-50")
                    $("#xmark"+galleryId).removeClass("block").toggleClass("hidden")
                } else {
                    deletedFile.push(galleryId);
                    $(this).toggleClass("brightness-50")
                    $("#xmark"+galleryId).removeClass("hidden").toggleClass("block")
                }
                if(deletedFile.length > 0){
                    $("#deletedGalleryId").val(JSON.stringify(deletedFile));
                }
                else{
                    $("#deletedGalleryId").val(null);
                }
            })
        })

    </script>
@endpush

