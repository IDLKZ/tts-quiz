@extends('layout-employee')
@section('content')
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl text-black uppercase">
                            личный кабинет
                        </p>
                    </div>
                    <div class="col-12 col-md-6 my-2 text-right text-lg font-bold lg:text-xl xl:text-2xl text-black uppercase">
                        <a href="{{route("employeeSettings")}}">
                            <i class="fas fa-user-cog"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="grid grid-cols-12 gap-4 p-3 border-2 rounded-xl border-gray-400 min-h-[50vh]">
                    <div class="col-span-12 md:col-span-6 lg:col-span-3 my-2 flex justify-content-center">
                        <div>
                            <div class="flex justify-content-center align-items-center">
                                <img src="{{$user->img}}" class="mt-3 img-circle profile-avatar"
                                     alt="User avatar">
                            </div>
                            <h2 class="text-lg xl:text-xl text-black my-2">{{$user->name}}</h2>
                            <hr/>
                            <span><i class="fas fa-building mr-2"></i> {{$user->department->company->title}}</span><br>
                            <span><i class="fas fa-home mr-2"></i>{{$user->department->title}}</span><br>
                            <span><i class="fas fa-screwdriver mr-2"></i>{{$user->position}}</span><br>
                            <span><i class="fas fa-phone mr-2"></i>{{$user->phone}}</span><br>
                            <span><i class="fas fa-envelope mr-2"></i>{{$user->email}}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-5 my-2">
                        @if($schedules)
                            @if($schedules->isNotEmpty())
                                <section class="my-3">
                                <div class="mb-2">
                                    <p class="text-md lg:text-lg xl:text-2xl">
                                        Рабочий график
                                    </p>
                                </div>
                                <div class="relative table-responsive overflow-x-auto sm:rounded-lg">
                                    @foreach($schedules as $schedule)
                                        <div class="my-2">
                                            <a href="{{route("employee-schedule-show",$schedule->id)}}" class="block  p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                                                <p class="mb-2 text-md md:text-lg font-bold tracking-tight text-gray-900">{{\Illuminate\Support\Str::limit($schedule->title,50)}}</p>
                                                <div class="flex my-2 align-items-center">
                                                    <img class="mr-2 w-6 h-6 rounded-full" src="{{$schedule->user->img}}">
                                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-400 ml-2">
                                                        {{$schedule->user->name}}
                                                    </p>
                                                </div>
                                                <p class="text-md text-success">
                                                    <i class="fas fa-calendar mr-2"></i>{{$schedule->start_at->format("d/m/Y H:i")}} -  {{$schedule->end_at->format("d/m/Y H:i")}}
                                                </p>
                                                <p class="text-sm font-normal text-gray-700 dark:text-gray-400">
                                                    {!! \Illuminate\Support\Str::limit($schedule->description,50) !!}
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </section>
                            @endif
                        @endif
                        @if($attempts)
                            @if($attempts->isNotEmpty())
                                    <section class="my-3">
                                        <div class="mb-2">
                                            <p class="text-md lg:text-lg xl:text-2xl">
                                                Ваши попытки сдачи
                                            </p>
                                        </div>
                                        <div class="relative table-responsive overflow-x-auto shadow-md sm:rounded-lg">

                                            @foreach($attempts as $attempt)

                                                <a href="{{route("exam-result",$attempt->id)}}" class="block my-3 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                                        @if($attempt->passed_lessons)
                                                            <i class="fas fa-check-circle text-green-500"></i>

                                                        @else
                                                            <i class="fas fa-times-circle text-red-500"></i>
                                                        @endif
                                                        {{$attempt->lesson->title}}
                                                    </h5>
                                                    <p class="font-normal text-lg text-gray-700 dark:text-gray-400">
                                                        Набрано:{{$attempt->points}} балла
                                                    </p>
                                                </a>
                                            @endforeach

                                        </div>
                                    </section>
                            @endif
                        @endif

                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-4 my-2">
                        <section class="flex justify-content-center">
                            @if($tasks->isNotEmpty())
                                <div class="flex align-items-center justify-content-center mb-3">
                                    <div class="w-full max-w-[350px] shadow-lg bg-white min-h-[300px] rounded-2xl relative p-4">
                                        <div class="header-card-title flex justify-content-between">
                                            <p class="text-md lg:text-lg text-rose-500 font-weight-bold">Важные задания</p>
                                            <a href="{{route("employee-tasks")}}">
                                                <i class="fas fa-eye text-rose-500"></i>
                                            </a>
                                        </div>
                                        @foreach($tasks as $task)
                                            <div class="card-row-body my-3">
                                                <div class="flex align-items-center">
                                                    <div class="min-w-8 w-1/12">
                                                        <img class="w-6 h-6 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr" src="{{$task->user->img}}">
                                                    </div>
                                                    <a href="{{route("employee-task-detail",$task->id)}}" class="min-w-8 justify-content-between flex w-10/12">
                                                        <div class="word-break pl-2 w-2/3">
                                                            <p class="text-md">
                                                                {{$task->user->name}}
                                                            </p>
                                                            <small class="text-xs my-2">
                                                                {{$task->task}}
                                                            </small>
                                                        </div>
                                                        <small class="text-xs ml-2 text-left w-1/3">
                                                            {{$task->created_at->diffForHumans()}}
                                                        </small>
                                                    </a>

                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="absolute bottom-0 left-0 w-full min-h-[30px] mt-3 bg-rose-500 rounded-br-2xl rounded-bl-2xl text-left">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </section>
                        <section class="flex justify-content-center">
                            @if($forums->isNotEmpty())
                                <div class="flex align-items-center justify-content-center mb-3">
                                    <div class="w-full max-w-[350px] shadow-lg bg-white min-h-[300px] rounded-2xl relative p-4">
                                        <div class="header-card-title flex justify-content-between">
                                            <p class="text-md lg:text-lg text-yellow-500 font-weight-bold">Форумы</p>
                                            <a href="{{route("forum-list")}}">
                                                <i class="fas fa-eye text-yellow-500"></i>
                                            </a>
                                        </div>
                                        @foreach($forums as $forum)
                                            <div class="card-row-body my-3">
                                                <div class="flex align-items-center">
                                                    <div class="min-w-8 w-1/12">
                                                        <img class="w-6 h-6 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr" src="{{$forum->user->img}}">
                                                    </div>
                                                    <div class="min-w-8 justify-content-between flex w-10/12">
                                                        <div class="word-break pl-2  w-3/4">
                                                            <a href="{{route("forumDetail",$forum->id)}}" class="text-md">
                                                                {{\Illuminate\Support\Str::limit($forum->title,30)}}
                                                            </a><br/>
                                                            <small class="text-xs my-2">
                                                                {!! \Illuminate\Support\Str::limit(strip_tags($forum->description),30) !!}
                                                            </small>
                                                        </div>
                                                        <small class="text-xs ml-2 text-left min-w-[40px]  w-1/4">
                                                            {{$forum->created_at->diffForHumans()}}
                                                        </small>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="absolute bottom-0 left-0 w-full min-h-[30px] mt-3 bg-yellow-500 rounded-br-2xl rounded-bl-2xl">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </section>

                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
