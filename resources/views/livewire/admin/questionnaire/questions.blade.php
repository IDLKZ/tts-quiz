<div class="bg-white my-3 p-3">
    <div class="page-content-wrapper">
        <div class="container">
            <div class="row my-5">
                @if($activeQuestion)
                    <div class="col-12 my-3 text-right">
                        <button class="btn btn-success text-white" wire:click="createQuestion()">
                            Создать новый вопрос
                        </button>
                    </div>
                @endif

                <div class="col-12 col-md-6 my-3">
                    <div class="table-responsive w-full bg-white p-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Вопросы</th>
                                <th scope="col">Контекст</th>
                                <th scope="col">Кол-во ответов</th>
                                <th scope="col">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>
                                        {{$question->question}}
                                    </td>
                                    <td>{!! $question->context !!}</td>
                                    <td>{{$question->questionnaire_answers_count}}</td>
                                    <td>
                                        <div class="flex justify-content-around items-center h-full">
                                            <button class="btn btn-info mx-1 rounded-full flex justify-center items-center w-8 h-8 text-white" wire:click="showQuestion({{$question->id}})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-info mx-1 rounded-full flex justify-center items-center w-8 h-8 text-white" wire:click="editQuestion({{$question->id}})">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button class="btn btn-danger mx-1 rounded-full flex justify-center items-center w-8 h-8 text-white" wire:click="deleteQuestion({{$question->id}})">
                                                X
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6 my-3">
                    @if($activeQuestion == null)
                        <div class="create-question">
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Вопрос *</label>
                                <div>
                                    <input  wire:model="question" class="form-control  @error('question') is-invalid @enderror" name="question" type="text" value="{{old("question")}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Детали</label>
                                <div>
                                    <input  wire:model="context" class="form-control  @error('context') is-invalid @enderror" name="context" type="text" value="{{old("context")}}" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Порядок*</label>
                                <div>
                                    <input  wire:model="order" class="form-control  @error('order') is-invalid @enderror" name="order" type="number" min="1" max="1000" value="{{old("order")}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class=" col-form-label">Кол-во возможных ответов*</label>
                                <div>
                                    <input  wire:model="max_answer" class="form-control  @error('max_answer') is-invalid @enderror" name="max_answer" type="number" min="1" max="20" value="{{old("max_answer")}}" >
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-success text-white" wire:click="saveQuestions()">
                                    Создать Вопрос
                                </button>
                            </div>
                        </div>
                    @endif
                    @if($activeQuestion)
                        @if($type == "show")
                            <div class="card p-3">
                                <p class="text-2xl font-bold mb-3">
                                    {{$activeQuestion->question}}
                                </p>
                                <p class="mb-2">
                                    {!! $activeQuestion->context !!}
                                </p>
                                @if($activeQuestion->questionnaire_answers)
                                    @foreach($activeQuestion->questionnaire_answers as $answerItem)
                                        <div class="grid grid-cols-12 rounded-xl w-full p-3 my-2 border">
                                            <div class="col-span-12 sm:col-span-9 my-2">
                                                {{$answerItem->answer}}
                                            </div>
                                            <div class="col-span-12 flex justify-content-around sm:col-span-3 my-2">
                                                <button class="btn btn-info rounded-full flex justify-center items-center w-8 h-8 text-white" wire:click="editAnswer({{$answerItem->id}})">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button class="btn btn-danger rounded-full flex justify-center items-center w-8 h-8 text-white" wire:click="deleteAnswer({{$answerItem->id}})">
                                                    <i class="fas fa-window-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($activeAnswer)
                                    <div class="col-12 my-3 text-right">
                                        <button class="btn btn-success text-white" wire:click="createAnswer()">
                                            Создать новый ответ
                                        </button>
                                    </div>
                                @endif
                                <hr/>
                                @if($activeAnswer == null)
                                    <div class="my-3">
                                        <div class="create-answer">
                                            <p class="text-lg font-bold">
                                                Добавить новый ответ
                                            </p>
                                            <div class="form-group">
                                                <label for="example-text-input" class=" col-form-label">Ответ *</label>
                                                <div>
                                                    <input  wire:model="answer" class="form-control  @error('answer') is-invalid @enderror" name="answer" type="text" value="{{old("answer")}}" >
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-success text-white" wire:click="saveAnswer()">
                                                    Добавить ответ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($activeAnswer)
                                    <div class="my-3">
                                        <div class="create-answer">
                                            <p class="text-lg font-bold">
                                                Изменить ответ
                                            </p>
                                            <div class="form-group">
                                                <label for="example-text-input" class=" col-form-label">Ответ *</label>
                                                <div>
                                                    <input  wire:model="answer" class="form-control  @error('answer') is-invalid @enderror" name="answer" type="text" value="{{old("answer")}}" >
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-success text-white" wire:click="updateAnswer()">
                                                    Изменить ответ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                            @if($type == "edit")
                                <div class="create-question">
                                    <div class="form-group">
                                        <label for="example-text-input" class=" col-form-label">Вопрос *</label>
                                        <div>
                                            <input  wire:model="question" class="form-control  @error('question') is-invalid @enderror" name="question" type="text" value="{{old("question")}}" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-text-input" class=" col-form-label">Детали</label>
                                        <div>
                                            <input  wire:model="context" class="form-control  @error('context') is-invalid @enderror" name="context" type="text" value="{{old("context")}}" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class=" col-form-label">Порядок*</label>
                                        <div>
                                            <input  wire:model="order" class="form-control  @error('order') is-invalid @enderror" name="order" type="number" min="1" max="1000" value="{{old("order")}}" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class=" col-form-label">Кол-во возможных ответов*</label>
                                        <div>
                                            <input  wire:model="max_answer" class="form-control  @error('max_answer') is-invalid @enderror" name="max_answer" type="number" min="1" max="20" value="{{old("max_answer")}}" >
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-success text-white" wire:click="changeQuestion()">
                                            Изменить Вопрос
                                        </button>
                                    </div>
                                </div>
                            @endif
                    @endif

                </div>
            </div>
            <!-- end col -->
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
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
