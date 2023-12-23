@extends("layout")
@section("content")
    <div class="main-content">

        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Список вопросов</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
                                <li class="breadcrumb-item active">Список вопросов</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{route("question.create")}}" class="btn btn-light btn-rounded dropdown-toggle">
                                        <i class="mdi mdi mdi-plus-thick  mr-1"></i> Добавить
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container">
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
