@extends('layout-employee')
@push("styles")
    <style>
        .list-answer{
            background-color: #1fad70 !important;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 30px!important;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
        }
        .list-answer:hover{
            cursor: pointer;
        }
        .liter{
            background-color: white;
            width: 30px;
            min-height: 30px;
            border-radius: 30px;
            color: #1A202C;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 5px;
            margin-right: 5px;
        }
        .nav-item{
            margin-top: 2px;
            border: 1px solid;
            border-radius: .25rem;
        }
    </style>
@endpush
@section('content')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h4 class="page-title mb-1">Пройти тест</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Главная</a></li>
                                <li class="breadcrumb-item active">Тест {{$soloviev_quiz->title}}</li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">{{$soloviev_quiz->title}}</h4>
                                    <p class="card-title-desc">
                                        {{$soloviev_quiz->description}}
                                    </p>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <hr>

                                    <!-- Nav tabs -->

                                    <ul class="nav nav-pills my-3" id="myTab" role="tablist">
                                        <li class="nav-item mr-1 nav-data">
                                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#data" role="tab" aria-controls="home" aria-selected="true">Данные</a>
                                        </li>
                                        @foreach($soloviev_questions as $question)
                                        <li class="nav-item my-nav-item mr-1" data-number="{{$question->number}}" id="tab{{$question->id}}">
                                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#question{{$question->number}}" role="tab" aria-controls="home" aria-selected="true">{{$question->number}}</a>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <hr>
                                    <form action="{{route("solovievCheck")}}" method="post">
                                    @csrf
                                        <input  hidden id = "answers" name="oven_answer" value="">
                                        <input  hidden  name="invite" value="{{$invite->id}}">
{{--                                        Вопросы--}}
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane show" id="data" role="tabpanel" aria-labelledby="home-tab">
                                                <p class="card-text">Выберите профессиональную позицию</p>
                                                <select name="job_id" class="form-control" id="job_id">
                                                    <option value="0">Не выбрано</option>
                                                    @foreach($jobs as $job)
                                                    <option value="{{$job->id}}">{{$job->title}}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        @foreach($soloviev_questions as $question)
                                        <div class="tab-pane fade" id="question{{$question->number}}" role="tabpanel" aria-labelledby="home-tab">
                                            @if($question->test_type == 1)
                                                <h5 class="font-size-14 mb-3">Вопрос № {{$question->number}}. {{$question->question}} ({{$question->testType->title}})</h5>
                                                <div class="form-group wrapper">
                                                    <label for="exampleFormControlSelect1">Сортируйте ответы от наиболее подходящего к наименее для Вас</label>
                                                    <ul class="list-group" id="{{$question->id}}">
                                                        <li class="list-group-item active border-white list-answer" value="A"><span class="liter">А</span>{{$question->A}}</li>
                                                        <li class="list-group-item active border-white list-answer" value="B"><span class="liter">Б</span>{{$question->B}}</li>
                                                        <li class="list-group-item active border-white list-answer" value="C"><span class="liter">В</span>{{$question->C}}</li>
                                                        <li class="list-group-item active border-white list-answer" value="D"><span class="liter">Г</span>{{$question->D}}</li>
                                                        <li class="list-group-item active border-white list-answer" value="E"><span class="liter">Д</span>{{$question->E}}</li>
                                                        <li class="list-group-item active border-white list-answer" value="F"><span class="liter">Е</span>{{$question->F}}</li>
                                                    </ul>
                                                </div>
                                            @endif

                                          @if($question->test_type == 2 || $question->test_type == 3)
                                                <h5 class="font-size-14 mb-3">Вопрос № {{$question->number}}. {{$question->question}} ({{$question->testType->title}})</h5>
                                                <div class="custom-control custom-radio mb-2">
                                                    <div class="custom-control custom-radio mb-2">
                                                        @if($question->A)
                                                            <div class="form-check">
                                                                <input required class="form-check-input"data-number="{{$question->number}}" type="radio" name="answer[{{$question->test_type}}][{{$question->id}}][]" id="A{{$question->id}}" value="A">
                                                                <label class="form-check-label" for="A{{$question->id}}">
                                                                    {{$question->A}}
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input required class="form-check-input"data-number="{{$question->number}}" type="radio" name="answer[{{$question->test_type}}][{{$question->id}}][]" id="B{{$question->id}}" value="B">
                                                                <label class="form-check-label" for="B{{$question->id}}">
                                                                    {{$question->B}}
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input required class="form-check-input"data-number="{{$question->number}}" type="radio" name="answer[{{$question->test_type}}][{{$question->id}}][]" id="C{{$question->id}}" value="C">
                                                                <label class="form-check-label" for="C{{$question->id}}">
                                                                    {{$question->C}}
                                                                </label>
                                                            </div>
                                                            @if($question->D)
                                                                <div class="form-check">
                                                                    <input required class="form-check-input"data-number="{{$question->number}}" type="radio" name="answer[{{$question->test_type}}][{{$question->id}}][]" id="D{{$question->id}}" value="D">
                                                                    <label class="form-check-label" for="D{{$question->id}}">
                                                                        {{$question->D}}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($question->E)
                                                                <div class="form-check">
                                                                    <input required class="form-check-input"data-number="{{$question->number}}" type="radio" name="answer[{{$question->test_type}}][{{$question->id}}][]" id="E{{$question->id}}" value="E">
                                                                    <label class="form-check-label" for="E{{$question->id}}">
                                                                        {{$question->E}}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($question->F)
                                                                <div class="form-check">
                                                                    <input required class="form-check-input"data-number="{{$question->number}}" type="radio" name="answer[{{$question->test_type}}][{{$question->id}}][]" id="F{{$question->id}}" value="F">
                                                                    <label class="form-check-label" for="F{{$question->id}}">
                                                                        {{$question->F}}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                          @endif
                                        </div>
                                        @endforeach
                                        <hr>
                                    </div>
                                        <div class="text-right mt-5">
                                            <button class="btn btn-info" id="check">Отправить</button>
                                        </div>
                                    </form>




                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                </div>
                <!-- end container -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->



    </div>
    <!-- end main content-->

@endsection
@push("scripts")
    <script src="/js/ddsort.min.js"></script>
    <script>
            let checked = [];
            checkedSelect()
            checkedInput();
            $("input").on("change",function (){changeColor($(this).attr("data-number"));checkedInput();checkButton();});
            $("#job_id").on("change",function () {checkSelect($(this).val());checkButton()})
            $(".my-nav-item").on("click",function (){
                    let number = Number.parseInt($(this).attr("data-number"));
                    let arr = [1,3,5,7,9,11,13,15,17,19];
                    if(arr.includes(number)){
                        changeColor(number)}
                })
            function checkedInput(){checked = [];$('input[type=radio]').each(function () {if(this.checked){let id = ($(this).attr("id"));checked.push(id);changeColor($(this).attr("data-number"))}});}
            function checkedSelect(){ checkSelect($("#job_id").val()); return $("#job_id").val()}
            function checkSelect(data){ if(data>0){$(".nav-data").css("background","#1fad70 ")} else{$(".nav-data").css("background","white ")}}
            function changeColor(i){$("#tab"+i).css("background","#1fad70 ")}
            $("#check").attr("disabled","disabled");
            function sortingAnswer(){
                let uls = $("ul.list-group");
                let answers = [];
                let array = [];

                for (let i = 0; i< uls.length; i++){
                    let id = $(uls[i]).attr("id");
                    let lis = $("#"+id+" li");
                    for (let l = 0; l < lis.length; l++){
                        array.push($(lis[l]).attr("value"));
                    }
                    answers.push({'question_id':id, "value":array})
                    array = [];

                }
                $('[name="oven_answer"]').val(JSON.stringify(answers));
            }
            sortingAnswer();
            function checkButton(){if(checked.length == 11 && checkedSelect() > 0){$("#check").attr("disabled",false);}else{$("#check").attr("disabled",true);}}
            $( '.wrapper' ).DDSort({

                // element to be sorted
                target: 'li',

                // custom CSS styles for active element
                floatStyle: {},

                // custom CSS styles for placeholder
                cloneStyle: {},

                // triggered on mouse down
                down: function(){
                    sortingAnswer()
                },

                // triggered on mouse move
                move: function(){
                    sortingAnswer()
                },

                // triggered on mouse up
                up: function(){
                    sortingAnswer()
                },

            });

    </script>
@endpush
