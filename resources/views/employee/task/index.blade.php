@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                            Список Задач
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список задач.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->

            <!-- end row -->

            <!-- end page title end breadcrumb -->
            @if($tasks)
                <div class="container">
                    <div class="row my-5">
                        @if(in_array(0,$tasks->keys()->toArray()))
                            <div class="col-12 col-lg-6 col-xl-4 p-3">
                                <div class="text-lg lg:text-xl xl:text-2xl text-center">
                                    <p class="text-black font-weight-bold ml-2">
                                        К выполнению
                                    </p>
                                </div>
                                @foreach($tasks[0] as $taskStarted)
                                    <div class="card position-relative shadow-lg rounded-2xl min-h-[300px] bg-white my-3 p-4">
                                        <div class="flex justify-content-between">
                                            <div class="w-1/2 border-b-[1px] border-gray-300">
                                                <p class="text-md lg:text-lg xl:text-xl text-black font-weight-bold ml-2">
                                                    Задача #{{$taskStarted->id}}
                                                </p>
                                            </div>
                                            <div class="w-1/2 flex justify-content-end border-gray-300">
                                                <img src="/images/navbar-logo.png" class="max-w-[20px]"/>
                                            </div>
                                        </div>
                                        <div class="flex my-4 align-items-center text-black text-uppercase">
                                            @if($taskStarted->status == 0)
                                                <div class="w-4 h-4 rounded-full bg-success"></div>
                                                <p class="text-md ml-2">
                                                    Низкий приоритет
                                                </p>
                                            @endif
                                            @if($taskStarted->status == 1)
                                                <div class="w-4 h-4 rounded-full bg-warning"></div>
                                                <p class="text-md ml-2">
                                                    Средний приоритет
                                                </p>
                                            @endif
                                            @if($taskStarted->status == 2)
                                                <div class="w-4 h-4 rounded-full bg-danger"></div>
                                                <p class="text-md ml-2">
                                                    Высокий приоритет
                                                </p>
                                            @endif
                                        </div>
                                        <div class="align-items-center text-black text-uppercase position-relative">
                                            <p class="text-md lg:text-lg ml-2 my-2">
                                                {{$taskStarted->task}}
                                            </p>
                                            <div class="text-xs ml-2 my-2 pl-2">
                                                {!! $taskStarted->details !!}
                                            </div>
                                        </div>
                                        <div class="my-3 pb-4 text-black text-sm">
                                            <p class="pb-2">Руководитель:</p>
                                            <a href="{{route("user.show",$taskStarted->user_id)}}" class="inline-block w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                               title="{{$taskStarted->user->name}}"
                                               style="background-image: url({{$taskStarted->user->img}})">
                                            </a>
                                            <p class="pb-2">Исполняющие сотрудники:</p>
                                            <div class="avatar-stack flex">
                                                @foreach($taskStarted->getUsers() as $activeUser)
                                                    <a href="{{route("user.show",$activeUser->id)}}" class="w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                                       title="{{$activeUser->name}}"
                                                       style="background-image: url({{$activeUser->img}})">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="rounded-br-xl rounded-bl-xl bg-yellow-500 position-absolute position-absolute left-0 bottom-0 w-full p-2">
                                            <div class="flex align-items-center justify-content-between text-white h-full position-relative font-weight-bold px-3">
                                                {{$taskStarted->department->title}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if(in_array(1,$tasks->keys()->toArray()))
                            <div class="col-12 col-lg-6 col-xl-4 p-3">
                                <div class="text-lg lg:text-xl xl:text-2xl text-center">
                                    <p class="text-black font-weight-bold ml-2">
                                        В процессе
                                    </p>
                                </div>
                                @foreach($tasks[1] as $taskRunning)
                                    <div class="card position-relative shadow-lg rounded-2xl min-h-[300px] bg-white my-3 p-4">
                                        <div class="flex justify-content-between">
                                            <div class="w-1/2 border-b-[1px] border-gray-300">
                                                <p class="text-md lg:text-lg xl:text-xl text-black font-weight-bold ml-2">
                                                    Задача #{{$taskRunning->id}}
                                                </p>
                                            </div>
                                            <div class="w-1/2 flex justify-content-end border-gray-300">
                                                <img src="/images/navbar-logo.png" class="max-w-[20px]"/>
                                            </div>
                                        </div>
                                        <div class="flex my-4 align-items-center text-black text-uppercase">
                                            @if($taskRunning->status == 0)
                                                <div class="w-4 h-4 rounded-full bg-success"></div>
                                                <p class="text-md ml-2">
                                                    Низкий приоритет
                                                </p>
                                            @endif
                                            @if($taskRunning->status == 1)
                                                <div class="w-4 h-4 rounded-full bg-warning"></div>
                                                <p class="text-md ml-2">
                                                    Средний приоритет
                                                </p>
                                            @endif
                                            @if($taskRunning->status == 2)
                                                <div class="w-4 h-4 rounded-full bg-danger"></div>
                                                <p class="text-md ml-2">
                                                    Высокий приоритет
                                                </p>
                                            @endif
                                        </div>
                                        <div class="align-items-center text-black text-uppercase position-relative">
                                            <p class="text-md lg:text-lg ml-2 my-2">
                                                {{$taskRunning->task}}
                                            </p>
                                            <div class="text-xs ml-2 my-2 pl-2">
                                                {!! $taskRunning->details !!}
                                            </div>
                                        </div>
                                        <div class="my-3 pb-4 text-black text-sm">
                                            <p class="pb-2">Руководитель:</p>
                                            <a href="{{route("user.show",$taskRunning->user_id)}}" class="inline-block w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                               title="{{$taskRunning->user->name}}"
                                               style="background-image: url({{$taskRunning->user->img}})">
                                            </a>
                                            <p class="pb-2">Исполняющие сотрудники:</p>
                                            <div class="avatar-stack flex">
                                                @foreach($taskRunning->getUsers() as $activeUser)
                                                    <a href="{{route("user.show",$activeUser->id)}}" class="w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                                       title="{{$activeUser->name}}"
                                                       style="background-image: url({{$activeUser->img}})">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="rounded-br-xl rounded-bl-xl bg-yellow-500 position-absolute position-absolute left-0 bottom-0 w-full p-2">
                                            <div class="flex align-items-center justify-content-between text-white h-full position-relative font-weight-bold px-3">
                                                {{$taskRunning->department->title}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if(in_array(2,$tasks->keys()->toArray()))
                            <div class="col-12 col-lg-6 col-xl-4 p-3">
                                <div class="text-lg lg:text-xl xl:text-2xl text-center">
                                    <p class="text-black font-weight-bold ml-2">
                                        Выполненые задачи
                                    </p>
                                </div>
                                @foreach($tasks[2] as $taskEnded)
                                    <div class="card position-relative shadow-lg rounded-2xl min-h-[300px] bg-white my-3 p-4">
                                        <div class="flex justify-content-between">
                                            <div class="w-1/2 border-b-[1px] border-gray-300">
                                                <p class="text-md lg:text-lg xl:text-xl text-black font-weight-bold ml-2">
                                                    Задача #{{$taskEnded->id}}
                                                </p>
                                            </div>
                                            <div class="w-1/2 flex justify-content-end border-gray-300">
                                                <img src="/images/navbar-logo.png" class="max-w-[20px]"/>
                                            </div>
                                        </div>
                                        <div class="flex my-4 align-items-center text-black text-uppercase">
                                            @if($taskEnded->status == 0)
                                                <div class="w-4 h-4 rounded-full bg-success"></div>
                                                <p class="text-md ml-2">
                                                    Низкий приоритет
                                                </p>
                                            @endif
                                            @if($taskEnded->status == 1)
                                                <div class="w-4 h-4 rounded-full bg-warning"></div>
                                                <p class="text-md ml-2">
                                                    Средний приоритет
                                                </p>
                                            @endif
                                            @if($taskEnded->status == 2)
                                                <div class="w-4 h-4 rounded-full bg-danger"></div>
                                                <p class="text-md ml-2">
                                                    Высокий приоритет
                                                </p>
                                            @endif
                                        </div>
                                        <div class="align-items-center text-black text-uppercase position-relative">
                                            <p class="text-md lg:text-lg ml-2 my-2">
                                                {{$taskEnded->task}}
                                            </p>
                                            <div class="text-xs ml-2 my-2 pl-2">
                                                {!! $taskEnded->details !!}
                                            </div>
                                        </div>
                                        <div class="my-3 pb-4 text-black text-sm">
                                            <p class="pb-2">Руководитель:</p>
                                            <a href="{{route("user.show",$taskEnded->user_id)}}" class="inline-block w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                               title="{{$taskEnded->user->name}}"
                                               style="background-image: url({{$taskEnded->user->img}})">
                                            </a>
                                            <p class="pb-2">Исполняющие сотрудники:</p>
                                            <div class="avatar-stack flex">
                                                @foreach($taskEnded->getUsers() as $activeUser)
                                                    <a href="{{route("user.show",$activeUser->id)}}" class="w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                                       title="{{$activeUser->name}}"
                                                       style="background-image: url({{$activeUser->img}})">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="rounded-br-xl rounded-bl-xl bg-yellow-500 position-absolute position-absolute left-0 bottom-0 w-full p-2">
                                            <div class="flex align-items-center justify-content-between text-white h-full position-relative font-weight-bold px-3">
                                                {{$taskEnded->department->title}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <!-- end col -->
                    <!-- end row -->
                </div>
            @endif

            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection
