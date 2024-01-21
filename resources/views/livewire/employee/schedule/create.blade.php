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
        <form id="js-form" action="{{route("employee-schedule.store")}}" method="post" enctype="multipart/form-data">
            @csrf

            @csrf
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Отдел *</label>
                <div>
                    <select wire:change="selectDepartment" wire:model="department_id" class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                        <option value="{{null}}">
                            Выберите департамент
                        </option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">
                                {{$department->title}} ({{$department->company->title}})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($department_id)
                <div class="form-group">
                    <label for="example-text-input" class=" col-form-label">Выберите сотрудника *</label>
                    <div>
                        <select class="form-control" wire:model="user_id" name="user_id">
                            <option value="{{null}}">
                                Выберите сотрудника
                            </option>
                            @if($users)
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">
                                        {{$user->name}} ({{$user->email}})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Наименование События *</label>
                <div>
                    <input  wire:model="title" class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{old("title")}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Описание События *</label>
                <div wire:ignore>
                    <textarea wire:model="description" id="editor" name="description"></textarea>
                </div>
            </div>
            <div class="form-group"  wire:ignore>
                <label for="example-text-input" class=" col-form-label">Дата начала *</label>
                <div>
                    <input id="start_date"  wire:model="start_at" class="form-control my-date @error('start_at') is-invalid @enderror" name="start_at" type="text" value="{{old("start_at")}}" >
                </div>
            </div>
            <div class="form-group" wire:ignore>
                <label for="example-text-input" class=" col-form-label">Дата окончания *</label>
                <div>
                    <input id="end_date"  wire:model="end_at" class="form-control my-date  @error('end_at') is-invalid @enderror" name="end_at" type="text" value="{{old("end_at")}}" >
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

            $('#start_date').datetimepicker({
                format: 'dd/mm/yyyy HH:mm',
                footer:true
            });
            $('#end_date').datetimepicker({
                format: 'dd/mm/yyyy HH:mm',
                footer:true
            });
        })

    </script>
@endpush
