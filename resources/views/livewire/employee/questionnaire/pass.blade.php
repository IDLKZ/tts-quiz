<form action="{{route("employee-questionnaire-check")}}" method="post">
    @csrf
    <input type="hidden" value="{{$questionnaire->id}}" name="questionnaire_id">
    @foreach($questions as $question)
        <div class="row border border-gray-200 p-3">
            <div class="col-12">
                <p class="text-xl font-bold mb-3">
                    {{$question->question}}
                </p>
                <p class="mb-2">
                    {!! $question->context !!}
                </p>
                <hr>
                @foreach($question->questionnaire_answers as $answer)
                    <div class="flex items-center my-2">
                        <input wire:model="answers.{{ $question->id }}" id="{{$answer->answer}}{{$answer->id}}" type="radio" value="{{$answer->id}}" name="answer[{{$question->id}}]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  cursor-pointer">
                        <label for="{{$answer->answer}}{{$answer->id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                            {{$answer->answer}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    @if(count($answers) == $questions->count())
        <div class="flex justify-content-end my-2">
            <button class="btn btn-success btn-lg">
                Сдать
            </button>
        </div>
    @endif


</form>
