<div class="container">
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12">
            <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                <div class="flex flex-col items-center pb-10 pt-3">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{$task->user->img}}" alt="{{$task->user}}"/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900">{{$task->user->name}}</h5>
                    <span class="text-sm text-gray-500">Руководитель задачи</span>
                    <div class="flex my-2 align-items-center text-black text-uppercase">
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
                    <div class="flex my-2 align-items-center text-black text-uppercase">
                        @if($task->status == 0)
                            <div class="w-4 h-4 rounded-full bg-red-500"></div>
                            <p class="text-sm ml-2 font-normal">
                                К выполнению
                            </p>
                        @endif
                        @if($task->status == 1)
                            <div class="w-4 h-4 rounded-full bg-yellow-500"></div>
                            <p class="text-sm ml-2 font-normal">
                                В процесс
                            </p>
                        @endif
                        @if($task->status == 2)
                            <div class="w-4 h-4 rounded-full bg-green-500"></div>
                            <p class="text-sm ml-2 font-normal">
                                Завершен
                            </p>
                        @endif
                    </div>
                    <div class="flex my-2 align-items-center text-gray-500">
                        {{$task->start_date->format("H:i d/m/Y")}} - {{$task->end_date->format("H:i d/m/Y")}}
                    </div>

                    <div class="mt-4 md:mt-6 p-4 w-full">
                        <p class="text-lg font-weight-bold text-gray-500">
                            Задача: {{$task->task}}
                        </p>
                        <div class="my-2">
                            <span class="text-md font-weight-bold text-gray-500">Описание:</span><br/>
                            {!! $task->details !!}
                        </div>
                    </div>
                    <div class="mt-2 md:mt-2 p-4 w-full">
                        <div class="flow-root">
                            <p class="text-lg font-weight-bold text-gray-500">
                                Сотрудники:
                            </p>
                            <ul role="list">
                                @foreach($task->getUsers() as $taskUser)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="{{$taskUser->img}}" alt="{{$taskUser->name}}">
                                            </div>
                                            <div class="flex-1 min-w-0 ms-4">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{$taskUser->name}}
                                                </p>
                                                <p class="text-sm text-gray-500">
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
                    @if($taskReports->isNotEmpty())
                        <div class="mt-2 md:mt-2 p-4 w-full">
                            <div class="flow-root">
                                <p class="text-lg font-weight-bold text-gray-500">
                                    Выполнено:
                                </p>
                                <ul role="list">
                                    @foreach($taskReports as $key=> $taskReportItems)
                                        @foreach($taskReportItems as $taskReportItem)
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <img class="w-8 h-8 rounded-full" src="{{$taskReportItem->user->img}}" alt="{{$taskReportItem->user->name}}">
                                                    </div>
                                                    <div class="flex-1 w-full min-w-0 ms-4">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{$taskReportItem->user->name}}
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{$taskReportItem->user->position}} <br/>
                                                            {{$taskReportItem->user->department->title}}
                                                        </p>
                                                        @if($taskReportItem->status == 0)
                                                            <p class="text-sm ml-2 font-normal">
                                                                <i class="fas fa-check-circle"></i> Этап к выполнению
                                                            </p>
                                                        @endif
                                                        @if($taskReportItem->status == 1)
                                                            <p class="text-sm ml-2 font-normal">
                                                                <i class="fas fa-check-circle"></i> Этап В процессе
                                                            </p>
                                                        @endif
                                                        @if($taskReportItem->status == 2)
                                                            <p class="text-sm ml-2 font-normal">
                                                                <i class="fas fa-check-circle"></i> Этап Завершен
                                                            </p>
                                                        @endif
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
            </div>

        </div>
    </div>
</div>
