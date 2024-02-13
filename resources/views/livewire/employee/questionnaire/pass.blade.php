<form action="{{route("employee-questionnaire-check")}}" method="post">
    @csrf
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
    <input type="hidden" value="{{$questionnaire->id}}" name="questionnaire_id">
    @foreach($questions as $question)
        <div class="row border border-gray-200 p-3">
            <div class="col-12">
                <p class="text-xl font-bold mb-3">
                    @if(array_key_exists($question->id,$answers))
                        @if(count($answers[$question->id]) == $question->max_answer)
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                        @else
                            <i class="fas fa-question-circle text-yellow-400 mr-2"></i>
                        @endif
                    @else
                        <i class="fas fa-question-circle text-yellow-400 mr-2"></i>
                    @endif

                    {{$question->question}}
                </p>
                <p class="mb-2">
                    {!! $question->context !!}
                </p>
                <hr>
                @foreach($question->questionnaire_answers as $answer)
                    <div class="flex items-center my-2">
                        <input
                            @if(array_key_exists($question->id,$answers))
                                @if(count($answers[$question->id]) == $question->max_answer && !array_key_exists($answer->id,$answers[$question->id]))
                                    disabled
                                @endif
                            @endif
                            wire:change="checkAnswer()"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 disabled:bg-gray-400  cursor-pointer"
                            name="answer[{{ $answer->question_id }}][]"
                            id="{{$answer->answer}}{{$answer->id}}" type="checkbox" value="{{ $answer->id }}" wire:model="answers.{{ $answer->question_id }}.{{ $answer->id }}">
                        <label for="{{$answer->answer}}{{$answer->id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                            {{$answer->answer}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    @if($max_answer == $given_answer)
        <div class="flex justify-content-end my-2">
            <button class="btn btn-success btn-lg">
                Сдать
            </button>
        </div>
    @endif


</form>
