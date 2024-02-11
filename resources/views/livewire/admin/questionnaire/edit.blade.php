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
        <form id="js-form" action="{{route("questionnaire.update",$questionnaire->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Сотрудники *</label>
                <div>
                    <x-select
                        label="Выберите департамент"
                        placeholder="Список департаментов"
                        multiselect
                        :options="$departmentLists"
                        option-label="title"
                        option-value="id"
                        wire:model="departments"
                    />
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Опросник *</label>
                <div>
                    <input  wire:model="title" class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{old("title")}}" >
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Детали *</label>
                <div wire:ignore>
                    <textarea wire:model="description" id="editor" name="description"></textarea>
                </div>
            </div>

            <div class="form-group"  wire:ignore>
                <label for="example-text-input" class=" col-form-label">Дата начала *</label>
                <div>
                    <input id="start_at"  wire:model="start_at" class="form-control my-date @error('start_date') is-invalid @enderror" name="start_at" type="text" value="{{old("start_at")}}" >
                </div>
            </div>
            <div class="form-group" wire:ignore>
                <label for="example-text-input" class=" col-form-label">Дата окончания *</label>
                <div>
                    <input id="end_at"  wire:model="end_at" class="form-control my-date  @error('end_date') is-invalid @enderror" name="end_at" type="text" value="{{old("end_at")}}" >
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

            $('#start_at').datetimepicker({
                format: 'dd/mm/yyyy HH:mm',
                footer:true
            });
            $('#end_at').datetimepicker({
                format: 'dd/mm/yyyy HH:mm',
                footer:true
            });
        })

    </script>
@endpush


