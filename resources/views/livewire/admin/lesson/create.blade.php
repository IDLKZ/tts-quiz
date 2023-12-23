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
        <form id="js-form" action="{{route("lesson.store")}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Курс *</label>
                <div>
                    <select wire:change="selectCourse" wire:model="course_id" class="form-control @error('course_id') is-invalid @enderror" name="course_id">
                        <option value="{{null}}">
                            Выберите курс
                        </option>
                        @foreach($courses as $course)
                            <option value="{{$course->id}}">
                                {{$course->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Наименование видеоурока *</label>
                <div>
                    <input  wire:model="title" class="form-control  @error('title') is-invalid @enderror" name="title" type="text" value="{{old("title")}}" >
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Подзаголовок видеоурока *</label>
                <div>
                    <input wire:model="subtitle" class="form-control  @error('subtitle') is-invalid @enderror" name="subtitle" type="text" value="{{old("subtitle")}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Номер видеоурока *</label>
                <div>
                    <input wire:model="order" class="form-control  @error('order') is-invalid @enderror" name="order" type="number" min="1" max="1000" value="{{old("order")}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Описание видеоурока *</label>
                <div wire:ignore>
                    <textarea wire:model="description" id="editor" name="description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Изображение *</label>
                <div>
                    <input class="form-control  @error('image_url') is-invalid @enderror" name="image_url" type="file" >
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Тип видеоурока *</label>
                <div>
                   <select class="form-control" wire:model="type" name="type">
                       <option value="{{null}}">
                           Выберите тип видео
                       </option>
                       <option value="youtube">
                           Youtube
                       </option>
                       <option value="download">
                           Download
                       </option>
                   </select>
                </div>
            </div>
            <section>
                @if($type == "youtube")
                    <div class="form-group">
                        <label for="example-text-input" class=" col-form-label">Ссылка видеоурока *</label>
                        <div>
                            <input wire:model="video_url" class="form-control  @error('video_url') is-invalid @enderror" name="video_url" type="text" value="{{old("video_url")}}" >
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Видео *</label>
                        <div>
                            <input class="form-control  @error('video') is-invalid @enderror" name="video_url" type="file" >
                        </div>
                    </div>
                @endif
            </section>
            <section>
                @if($course_id)
                    <div class="form-group">
                        <label for="example-text-input" class=" col-form-label">Предыдущий Видеоурок (необязательно)</label>
                        <div>
                            <select wire:model="prev_id" class="form-control @error('prev_id') is-invalid @enderror" name="prev_id">
                                <option value="{{null}}">Выберите урок</option>
                                @if($lessons)
                                    @foreach($lessons as $lesson)
                                        <option value="{{$lesson->id}}">
                                            # {{$lesson->order}} {{$lesson->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class=" col-form-label">Следующий Видеоурок (необязательно)</label>
                        <div>
                            <select wire:model="next_id" class="form-control @error('next_id') is-invalid @enderror" name="next_id">
                                <option value="{{null}}">Выберите урок</option>
                                @if($lessons)
                                    @foreach($lessons as $lesson)
                                        <option value="{{$lesson->id}}">
                                            # {{$lesson->order}} {{$lesson->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                @endif
            </section>

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
