@extends("layout")



@section("content")

    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Изменить опросник {{$questionnaire->title}}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route("questionnaire.index")}}">Опросник</a></li>
                                <li class="breadcrumb-item active">Изменить опросник {{$questionnaire->title}}</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper mt-[40px]">
                <div class="container">
                    <div class="row">
                        <div class="bg-white col-12 border-gray-200 border">
                            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6 w-full">
                                <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-3 dark:text-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{$count}}</dt>
                                        <dd class="font-light text-gray-500 dark:text-gray-400">сдач</dd>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{$user_count}}</dt>
                                        <dd class="font-light text-gray-500 dark:text-gray-400">пользователей</dd>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{$department_count}}</dt>
                                        <dd class="font-light text-gray-500 dark:text-gray-400">департаментов</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="bg-white col-12 border-gray-200 border">
                            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6 w-full">
                                <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 dark:text-white">
                                    <p class="text-xl font-bold mb-3">
                                        Статистика по дням
                                    </p>
                                    @foreach($results as $resultItem)
                                        <div class="flex flex-col items-center justify-center text-center w-full">
                                            <dt class="mb-2 text-2xl font-extrabold">{{$resultItem->count}} сдач</dt>
                                            <dd class="font-light text-gray-500 dark:text-gray-400">{{$resultItem->date}}</dd>
                                        </div>
                                    @endforeach
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="row border border-gray-200 p-3 bg-white">
                        <p class="text-xl font-bold mb-3">
                            Статистика по ответам



                        </p>
                        @foreach($questionnaire->questionnaire_questions as $question)
                            <div class="col-12">
                                <p class="text-xl font-bold mb-3">
                                    {{$question->question}}
                                </p>
                                <p class="mb-2">
                                    {!! $question->context !!}
                                </p>
                                <hr>
                                @foreach($question->questionnaire_answers as $answer)
                                    <div class="grid grid-cols-12 items-center my-2">
                                        <div class="col-span-8">
                                            @if(!array_key_exists($answer->id,$stats))
                                                <div class="bg-blue-500 h-5 rounded-xl" style="width: 1px"></div>
                                            @else
                                                    <?php $points = $stats[$answer->id][0]->total_points ?>
                                                <div
                                                    class="bg-blue-500 h-5 rounded-xl flex justify-center items-center text-white progress-bar-striped"
                                                    style="width: {{round($points/$count * 100,2)}}%">
                                                    {{round($points/$count * 100,2)}}%
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-span-2 text-right font-bold text-black my-2">
                                            @if(!array_key_exists($answer->id,$stats))
                                                0 (0%)
                                            @else
                                                    <?php $points = $stats[$answer->id][0]->total_points ?>
                                                {{$points}} ({{round($points/$count * 100,2)}})
                                            @endif
                                        </div>
                                        <div class="col-span-2 text-right font-bold text-black my-2">
                                            {{$answer->answer}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!-- end col -->

                    <!-- end row -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->


    </div>
@endsection
