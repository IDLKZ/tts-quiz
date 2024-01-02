@push("styles")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@extends('layout-employee')
@section('content')
    <div class="row bg-white shadow-lg rounded-lg my-2 py-4 px-3">
        <div class="col-12 my-2">
            <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                Создать идею
            </p>
            <p class="text-md font-bold lg:text-lg">
                Здесь вы можете создать идею для руководства компании.
            </p>
        </div>
        <div class="col-12 my-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-12 p-3">
            <form id="js-form" action="{{route("employee-idea.store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="example-text-input" class=" col-form-label">Тема идеи *</label>
                    <div>
                        <input  class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{old("title")}}" id="example-text-input">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class=" col-form-label">Описание Идеи *</label>
                    <div>
                        <textarea id="editor" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image-url-input" class=" col-form-label">Изображение идеи *</label>
                    <div>
                        <input class="form-control h-[55px] @error('image_url') is-invalid @enderror" name="image_url" type="file" id="image-url-input">
                    </div>
                </div>
                <div class="form-group">
                    <label for="image-url-input" class=" col-form-label">Ключевые слова идеи *</label>
                    <div>
                        <select class="w-full p-3" id="mySelect" name="keywords[]" multiple="multiple">
                            <!-- No predefined options here -->
                        </select>
                        <small>
                            Введите значение и нажмите Enter
                        </small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file-url-input" class="col-form-label">Файл идеи (необязателен)</label>
                    <div>
                        <input class="form-control h-[55px] @error('file_url') is-invalid @enderror" name="file_url" type="file" id="file-url-input">
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-success text-white">
                        Создать
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function (){
            ClassicEditor
                .create( document.querySelector( '#editor' ),
                    {
                        ckfinder: {
                            uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
                        }
                    }
                )
                .catch( error => {
                    console.error( error );
                } );
            $('#mySelect').select2(
                {
                    tags: true
                }
            );

        })

    </script>
@endpush
