<div class="container">
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 md:col-span-9 my-2">
            <div class="w-full h-full bg-white border border-gray-200 rounded-lg shadow p-3">
                <div class="md:flex">
                    <div class="w-2/3 my-2">
                        <p class="text-gray-400">
                            Задача № {{$task->id}} -
                            @if($task->status == 0)
                                <b class="text-rose-500">
                                    К выполнению
                                </b>
                            @endif
                            @if($task->status == 1)
                                <b class="text-yellow-500">
                                    В процессе
                                </b>
                            @endif
                            @if($task->status == 2)
                                <b class="text-green-500">
                                    Завершен
                                </b>
                            @endif
                        </p>
                    </div>
                    <div class="w-1/3 my-2 flex justify-content-end">
                        @if($task->importance == 0)
                            <div class="w-4 h-4 rounded-full bg-success"></div>
                            <p class="text-sm ml-2 font-normal">
                                Низкий приоритет
                            </p>
                        @endif
                        @if($task->importance == 1)
                            <div class="w-4 h-4 rounded-full bg-warning"></div>
                            <p class="text-sm ml-2 font-normal">
                                Средний приоритет
                            </p>
                        @endif
                        @if($task->importance == 2)
                            <div class="w-4 h-4 rounded-full bg-danger"></div>
                            <p class="text-sm ml-2 font-normal">
                                Высокий приоритет
                            </p>
                        @endif
                    </div>
                </div>
                <hr/>
                <div class="text-md text-gray-600 my-3">
                    <p class="text-lg font-weight-bold text-gray-500">
                        Задача: {{$task->task}}
                    </p>
                    <p class="text-md text-gray-600 my-3">
                        {!! $task->details !!}
                    </p>
                </div>
                <hr/>
                <div class="text-md text-gray-400 my-3">
                    @if($taskReports->isNotEmpty())
                        <div class="mt-2 md:mt-2 p-4 w-full">
                            <div class="flow-root">
                                <ul role="list">
                                    @foreach($taskReports as $key=> $taskReportItems)
                                        @switch($key)
                                            @case(0)
                                                <p class="text-md font-weight-bold text-rose-500">
                                                    Отчет по этапу "К выполнению"
                                                </p>
                                                @break
                                            @case(1)
                                                <p class="text-md font-weight-bold text-yellow-500">
                                                    Отчет по этапу "В процессе"
                                                </p>
                                                @break
                                            @case(2)
                                                <p class="text-md font-weight-bold text-green-500">
                                                    Отчет по этапу "Выполнено"
                                                </p>
                                                @break
                                        @endswitch
                                        @foreach($taskReportItems as $taskReportItem)
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <img class="w-8 h-8 rounded-full"
                                                             src="{{$taskReportItem->user->img}}"
                                                             alt="{{$taskReportItem->user->name}}">
                                                    </div>
                                                    <div class="flex-1 w-full min-w-0 ms-4">
                                                        <p class="text-lg font-bold text-gray-900">
                                                            {{$taskReportItem->user->name}}
                                                        </p>
                                                        <p class="text-xs text-gray-500">
                                                            {{$taskReportItem->user->position}} <br/>
                                                            {{$taskReportItem->user->department->title}}
                                                        </p>
                                                        <p class="text-green-400 text-xs font-bold">
                                                            Отчет создан:
                                                            {{$taskReportItem->created_at->format("H:i d/m/Y")}}
                                                            ({{$taskReportItem->created_at->diffForHumans()}})
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <hr/>
                <div class="mt-2 md:mt-2 p-4 w-full">
                    <div class="flow-root">
                        @if(!$taskReport && in_array($user->id,$task->users) && $task->status < 2 && $task->start_date < \Carbon\Carbon::now() && $task->end_date > \Carbon\Carbon::now())
                            <div class="my-2 text-right">
                                <button class="rounded-full px-5 py-3 rounded-full bg-success text-white"
                                        wire:model="ready" wire:click="completeLevel">
                                    <i class="fas fa-check"></i>
                                    Я завершил (-a) текущий уровень
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-3 my-2">
            <div class="w-full  h-full bg-white rounded-lg">
                <div class="md:flex bg-success text-white p-3 rounded-lg">
                    Дата создания: {{$task->start_date->format("H:i d.m.Y")}}
                </div>
                @if($task->status < 2)
                    <div class="md:flex text-xs text-rose-500 p-3">
                        Крайний срок: {{$task->end_date->format("H:i d.m.Y")}} ({{$task->end_date->diffForHumans()}})
                    </div>
                @else
                    <div class="md:flex text-xs text-green-500 p-3">
                        Завершен: {{$task->updated_at->format("H:i d.m.Y")}} ({{$task->updated_at->diffForHumans()}})
                    </div>
                @endif
                <hr/>
                <div class="text-md text-gray-600 my-3 p-3">
                    <div class="flow-root">
                        <p class="text-md font-weight-bold text-gray-500">
                            Исполняющие сотрудники:
                        </p>
                        <ul role="list">
                            @foreach($task->getUsers() as $taskUser)
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="w-10 h-10 rounded-full" src="{{$taskUser->img}}"
                                                 alt="{{$taskUser->name}}">
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-md font-medium text-gray-900">
                                                {{$taskUser->name}}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{$taskUser->position}} <br/>
                                                {{$taskUser->department->title}}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr/>
                <div class="text-md text-gray-600 my-3 p-3">
                    <div class="flow-root">
                        <p class="text-md font-weight-bold text-gray-500">
                            Руководитель:
                        </p>
                        <ul role="list">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-10 h-10 rounded-full" src="{{$task->user->img}}"
                                             alt="{{$task->user->name}}">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-md font-medium text-gray-900">
                                            {{$task->user->name}}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{$task->user->position}} <br/>
                                            {{$task->user->department->title}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

