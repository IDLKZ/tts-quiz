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
        <form id="js-form" action="{{route("question.update",$question->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
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
            <section>
                @if($course_id)
                    <div class="form-group">
                        <label for="example-text-input" class=" col-form-label">Видеоуроки</label>
                        <div>
                            <select wire:model="lesson_id" class="form-control @error('lesson_id') is-invalid @enderror" name="lesson_id">
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
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Вопрос *</label>
                <div>
                    <input  wire:model="text" class="form-control  @error('text') is-invalid @enderror" name="text" type="text" value="{{old("text")}}" >
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Контекст вопроса *</label>
                <div wire:ignore>
                    <textarea class="editor" wire:model="context" name="context"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ A *</label>
                <div wire:ignore>
                    <textarea class="answer_a" wire:model="a" name="a"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ B *</label>
                <div wire:ignore>
                    <textarea class="answer_b" wire:model="b" name="b"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ C *</label>
                <div wire:ignore>
                    <textarea class="answer_c" wire:model="c" name="c"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ D</label>
                <div wire:ignore>
                    <textarea class="answer_d" wire:model="d" name="d"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ E</label>
                <div wire:ignore>
                    <textarea class="answer_e" wire:model="e" name="e"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ F</label>
                <div wire:ignore>
                    <textarea class="answer_f" wire:model="f" name="f"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ G</label>
                <div wire:ignore>
                    <textarea class="answer_g" wire:model="g" name="g"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Ответ H</label>
                <div wire:ignore>
                    <textarea class="answer_h" wire:model="h" name="h"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class="col-form-label">Правильный ответ *</label>
                <div>
                    <select wire:model="correct_answer" class="form-control @error('correct_answer') is-invalid @enderror" name="correct_answer">
                        <option value="{{null}}">Выберите ответ</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                        <option value="e">E</option>
                        <option value="f">F</option>
                        <option value="g">G</option>
                        <option value="h">H</option>
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
            var allEditors = ['.editor','.answer_a','.answer_b','.answer_c','.answer_d','.answer_e','.answer_f','.answer_g','.answer_h'];
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor
                    .create( document.querySelector( allEditors[i] ),
                        {
                            ckfinder: {
                                uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
                            }
                        }
                    )
                    .catch( error => {
                        console.error( error );
                    } );
            }

        })

    </script>
@endpush

