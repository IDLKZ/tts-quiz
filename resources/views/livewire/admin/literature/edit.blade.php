<div class="row my-2 py-4">
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
    <div class="col-12 bg-white shadow-lg rounded-lg p-3">
        <form id="js-form" action="{{route("literature.update",$literature->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Категория литературы *</label>
                <div>
                    <select wire:model="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="{{null}}">
                            Выберите категорию
                        </option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Наименование Книги *</label>
                <div>
                    <input  wire:model="title" class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{old("title")}}" >
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Описание Книги *</label>
                <div wire:ignore>
                    <textarea wire:model="description" id="editor" name="description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="my-2">
                    <img class="max-w-[350px]" src="{{$literature->getFile("image_url")}}"/>
                </div>
                <label for="example-text-input" class=" col-form-label">Изображение книги</label>
                <div>
                    <input class="form-control  @error('image_url') is-invalid @enderror" name="image_url" type="file" >
                </div>
            </div>
            <div class="form-group">
                @if($literature->file_url)

                <div class="my-2">
                    <a class="btn btn-info text-white" href="{{$literature->getFile("file_url")}}" download >
                        Скачать книгу
                    </a>
                </div>
                @endif
                <label for="example-text-input" class=" col-form-label">Файл книги </label>
                <div>
                    <input class="form-control  @error('file_url') is-invalid @enderror" name="file_url" type="file" >
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
@push("scripts")
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
        })
    </script>
@endpush
