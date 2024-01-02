@push("styles")
    <style>
        #progress-bar{
            transition: width 0.2s ease-in-out;
        }
        .slick-dots{
            bottom: 0!important;
        }
        .slick-dots li button::before{
            font-size: 12px;
        }
        .slick-dots li.slick-active button::before{
            color: #eab308!important;
        }
    </style>
@endpush
@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold">
                            Результат тестирования #{{$attempt->id}}<br/>
                        </p>
                        <a href="{{route("lesson-show-employee",$lesson->alias)}}" class="text-md font-bold lg:text-lg">
                            По уроку: {{$lesson->title}} ({{$lesson->course->title}})
                        </a>
                        <p>
                            Баллов набрано: {{$attempt->points}}
                        </p>
                        @if($passed_lessons)
                            <p class="text-lg font-bold text-success">
                                Экзамен сдан <br>
                                Уникальный код {{$passed_lessons->uuid}}
                            </p>

                        @endif
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="progress w-full bg-gray-300 h-4" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <span id="progress-bar" class="bg-yellow-500 block"></span>
                        </div>
                    </div>
                    <div class="col-12">
                            <div class="slick-questions p-3" style="max-width: 100%">
                                @foreach($questions as $question)
                                    <div class="card bg-card p-4 max-w-full" style="min-height: 500px">
                                        <div class="card-header-quiz">
                                            @if($passed_questions_results[$question->id])
                                                <p class="text-green-500">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Вы ответили верно
                                                </p>
                                            @else
                                                <p class="text-red-500">
                                                    <i class="fas fa-times-circle mr-1"></i>
                                                    Вы ответили неверно
                                                </p>
                                            @endif

                                            <p class="text-gray-700 font-bold text-md lg:text-lg">
                                                {{$loop->iteration}}/{{count($questions)}})
                                                {{$question->text}}
                                            </p>
                                            <div class="text-gray-700 inline-block my-3 text-sm lg:text-md img-question">
                                                {!! $question->context !!}
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="card-body-quiz">
                                            @if($question->a)
                                                <div class="flex items-center mb-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'a' ? 'checked' : ''}}
                                                        disabled id="answer-a-{{$question->id}}" type="radio" value="a" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-a-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->a !!}

                                                    </label>
                                                </div>
                                            @endif
                                            @if($question->b)
                                                <div class="flex items-center my-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'b' ? 'checked' : ''}}
                                                        disabled id="answer-b-{{$question->id}}" type="radio" value="b" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-b-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->b !!}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($question->c)
                                                <div class="flex items-center mb-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'c' ? 'checked' : ''}}
                                                        disabled id="answer-c-{{$question->id}}" type="radio"  value="c" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-c-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->c !!}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($question->d)
                                                <div class="flex items-center mb-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'd' ? 'checked' : ''}}
                                                        disabled id="answer-d-{{$question->id}}" type="radio" value="d" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-d-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->d !!}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($question->e)
                                                <div class="flex items-center mb-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'e' ? 'checked' : ''}}
                                                        disabled id="answer-e-{{$question->id}}" type="radio" value="e" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-e-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->e !!}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($question->f)
                                                <div class="flex items-center mb-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'f' ? 'checked' : ''}}
                                                        disabled id="answer-f-{{$question->id}}" type="radio" value="f" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-f-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->f !!}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($question->g)
                                                <div class="flex items-center mb-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'g'? 'checked' : ''}}
                                                        disabled id="answer-g-{{$question->id}}" type="radio" value="g" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-g-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->g !!}
                                                    </label>
                                                </div>
                                            @endif
                                            @if($question->h)
                                                <div class="flex items-center mb-4 img-question">
                                                    <input
                                                        {{$passed_questions[$question->id] == 'h' ? 'checked' : ''}}
                                                        disabled id="answer-h-{{$question->id}}" type="radio" value="h" name="answers[{{$question->id}}]" class="w-4 h-4 text-yellow-600 bg-gray-100 border-yellow-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 focus:ring-2">
                                                    <label for="answer-h-{{$question->id}}" class="m-2 text-md font-medium text-gray-700">
                                                        {!! $question->h !!}
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </div>


                </div>


            </div>
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection

@push("scripts")
    <script>



        $(document).ready(function(){
            let allQuestions = ({{count($questions)}});
            changeWidth();
            let slider =  $('.slick-questions').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite:false,
                dots:true,
                adaptiveHeight: true
            });

            slider.on('afterChange', function(event, slick, currentSlide, nextSlide) {
                let slider = currentSlide + 1;
                changeWidth(slider)
            });

            function changeWidth(currentSlide = 1){
                let width = currentSlide/allQuestions * 100;
                width = Math.ceil(width);
                $("#progress-bar").css("width",width + "%");
            }

        });
    </script>
@endpush
