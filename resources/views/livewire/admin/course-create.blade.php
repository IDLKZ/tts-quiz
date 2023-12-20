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
    <div class="col-12">
        <form id="js-form" action="{{route("course.store")}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Наименование курса *</label>
                <div>
                    <input  wire:model="title" class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{old("title")}}" id="example-text-input">
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Подзаголовок курса *</label>
                <div>
                    <input wire:model="subtitle" class="form-control  @error('subtitle') is-invalid @enderror" name="subtitle" type="text" value="{{old("subtitle")}}" id="example-text-input">
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Описание курса *</label>
                <div wire:ignore>
                    <textarea wire:model="description" id="editor" name="description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Изображение курса *</label>
                <div>
                    <input class="form-control  @error('image_url') is-invalid @enderror" name="image_url" type="file" id="example-text-input">
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Для кого доступен курс (необязателен)*</label>
                <div wire:ignore>
                    <select multiple wire:model="departments" data-pharaonic="select2" data-component-id="companies" class="form-control py-5  @error('departments') is-invalid @enderror" name="departments[]">
                        @foreach($departments_list as $department)
                            <option value="{{$department->id}}">
                                {{$department->title}} ({{$department->company->title}})
                            </option>
                        @endforeach

                    </select>
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
