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
                    <div class="col-span-12 md:col-span-6 lg:col-span-4 my-2 flex justify-content-center">
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
                    <div class="col-span-12 md:col-span-6 lg:col-span-4 my-2 flex justify-content-center">

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
                                                    <div class="min-w-8 justify-content-between flex w-10/12">
                                                        <div class="word-break pl-2">
                                                            <p class="text-md">
                                                                {{$task->user->name}}
                                                            </p>
                                                            <small class="text-xs my-2">
                                                                {{$task->task}}
                                                            </small>
                                                        </div>
                                                        <small class="text-xs ml-2 text-left">
                                                            {{$task->created_at->diffForHumans()}}
                                                        </small>
                                                    </div>

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
                                                        <div class="word-break pl-2">
                                                            <p class="text-md">
                                                                {{$forum->title}}
                                                            </p>
                                                            <small class="text-xs my-2">
                                                                {!! strlen($forum->description)>30 ? substr($forum->description,0,50) . "..." : $forum->description !!}
                                                            </small>
                                                        </div>
                                                        <small class="text-xs ml-2 text-left min-w-[40px]">
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
