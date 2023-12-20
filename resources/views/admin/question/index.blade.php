@extends("layout")
@section("content")
    <div class="main-content">
        <div class="page-content">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p class="md:text-lg lg:text-2xl">
                                Список Тестов
                            </p>
                            <p class="text-sm lg:text-md">
                                Здесь вы можете увидеть список тестов
                            </p>
                        </div>
                        <div class="col-12 col-md-6 text-right">
                            <a href="{{route("question.create")}}" class="btn btn-primary">Создать Вопрос</a>
                        </div>
                    </div>

                    <div class="row my-5">

                            <div class="col-12 my-3">
                                <div class="table-responsive w-full bg-white p-3">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Урок</th>
                                        <th scope="col">Вопрос</th>
                                        <th scope="col">Верный ответ</th>
                                        <th scope="col">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($questions as $question)
                                        <tr>
                                            <th scope="row">
                                                <a target="_blank" href="{{route('lesson.edit',$question->lesson->id)}}">
                                                    #{{$question->order}}{{$question->lesson->title}} ({{$question->lesson->course->title}})
                                                </a>
                                            </th>
                                            <td>
                                                {{$question->text}}
                                            </td>
                                            <td>{{$question->correct_answer}}</td>
                                            <td>
                                                <div class="flex">
                                                    <a href="{{route("question.edit",$question->id)}}" class="btn btn-warning text-white mx-2">
                                                        <i class="fas fa-pen-alt"></i>
                                                    </a>
                                                    <form action="{{route('question.destroy',$question->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger bg-danger text-white mx-2">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                </div>
                            </div>

                            <div class="col-12 flex justify-content-center align-items-center">
                                {{$questions->links()}}
                            </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
