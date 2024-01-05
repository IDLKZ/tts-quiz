<div class="container">
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 my-2">
            <p class="text-lg font-weight-bold text-black">
                Задачи с {{$start_at->format("d/m/Y")}} - {{$end_at->format("d/m/Y")}}
            </p>
        </div>
        <div class="col-span-12 md:col-span-4">
            <div class="form-group">
                <label for="status_type" class=" col-form-label">Тип задачи *</label>
                <div>
                    <select wire:model="status" class="form-control @error('status') is-invalid @enderror" name="status">
                        <option value="{{null}}">
                            Все
                        </option>
                        <option value="0">
                            К выполнению
                        </option>
                        <option value="1">
                            В процессе
                        </option>
                        <option value="2">
                            Выполнено
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4">
            <div class="form-group">
                <label for="start_date" class=" col-form-label">Дата с</label>
                <div>
                    <input wire:model="start_at_input" wire:change="changeStart" type="date" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Дата начала" required>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4">
            <div class="form-group">
                <label for="end_at" class=" col-form-label">Дата по</label>
                <div>
                    <input wire:model="end_at_input" wire:change="changeEnd" type="date" id="end_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Дата окончания" required>
                </div>
            </div>
        </div>
    </div>

    @if($tasks)
            <div class="row my-5 border-[1px] border-gray-500 rounded-xl py-4 px-4">
                @if($tasks->has(0))
                    <div class="col-12 col-lg-6 col-xl-4 p-3">
                        <div class="text-lg lg:text-xl xl:text-2xl text-center">
                            <p class="text-black font-weight-bold ml-2">
                                К выполнению
                            </p>
                        </div>
                        @foreach($tasks[0] as $taskStarted)
                            <div class="card position-relative shadow-lg rounded-2xl min-h-[300px] bg-white my-3 p-4">
                                <a href="{{route("employee-task-detail",$taskStarted->id)}}">
                                    <div class="flex justify-content-between">
                                        <div class="w-1/2 border-b-[1px] border-gray-300">
                                            <p class="text-md lg:text-lg xl:text-xl text-black font-weight-bold ml-2">
                                                Задача #{{$taskStarted->id}}
                                            </p>
                                        </div>
                                        <div class="w-1/2 flex justify-content-end border-gray-300">
                                            <img src="/images/navbar-logo.png" class="max-w-[20px]"/>
                                            @if($user->id == $taskStarted->user_id)
                                                <form action="{{route('employee-task-delete',$taskStarted->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger bg-danger text-white rounded-full h-8 w-8 flex justify-content-center align-items-center mx-2">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex my-4 align-items-center text-black text-uppercase">
                                        @if($taskStarted->importance == 0)
                                            <div class="w-4 h-4 rounded-full bg-success"></div>
                                            <p class="text-md ml-2">
                                                Низкий приоритет
                                            </p>
                                        @endif
                                        @if($taskStarted->importance == 1)
                                            <div class="w-4 h-4 rounded-full bg-warning"></div>
                                            <p class="text-md ml-2">
                                                Средний приоритет
                                            </p>
                                        @endif
                                        @if($taskStarted->importance == 2)
                                            <div class="w-4 h-4 rounded-full bg-danger"></div>
                                            <p class="text-md ml-2">
                                                Высокий приоритет
                                            </p>
                                        @endif
                                    </div>
                                    <div class="align-items-center text-black text-uppercase position-relative">
                                        <p class="text-md lg:text-lg ml-2 my-2">
                                            {{\Illuminate\Support\Str::limit($taskStarted->task,30)}}
                                        </p>
                                    </div>
                                    <div class="my-3 pb-4 text-black text-sm">
                                        <p class="pb-2">Руководитель:</p>
                                        <a class="inline-block w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                           title="{{$taskStarted->user->name}}"
                                           style="background-image: url({{$taskStarted->user->img}})">
                                        </a>
                                        <p class="pb-2">Исполняющие сотрудники:</p>
                                        <div class="avatar-stack flex">
                                            @foreach($taskStarted->getUsers() as $activeUser)
                                                <a class="w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
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
                                </a>

                            </div>
                        @endforeach
                    </div>
                @endif
                    @if($tasks->has(1))
                    <div class="col-12 col-lg-6 col-xl-4 p-3">
                        <div class="text-lg lg:text-xl xl:text-2xl text-center">
                            <p class="text-black font-weight-bold ml-2">
                                В процессе
                            </p>
                        </div>
                        @foreach($tasks[1] as $taskRunning)
                            <div class="card position-relative shadow-lg rounded-2xl min-h-[300px] bg-white my-3 p-4">
                                <a href="{{route("employee-task-detail",$taskRunning->id)}}">
                                <div class="flex justify-content-between">
                                    <div class="w-1/2 border-b-[1px] border-gray-300">
                                        <p class="text-md lg:text-lg xl:text-xl text-black font-weight-bold ml-2">
                                            Задача #{{$taskRunning->id}}
                                        </p>
                                    </div>
                                    <div class="w-1/2 flex justify-content-end border-gray-300">
                                        <img src="/images/navbar-logo.png" class="max-w-[20px]"/>
                                        @if($user->id == $taskRunning->user_id)
                                            <form action="{{route('employee-task-delete',$taskRunning->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bg-danger text-white rounded-full h-8 w-8 flex justify-content-center align-items-center mx-2">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex my-4 align-items-center text-black text-uppercase">
                                    @if($taskRunning->importance == 0)
                                        <div class="w-4 h-4 rounded-full bg-success"></div>
                                        <p class="text-md ml-2">
                                            Низкий приоритет
                                        </p>
                                    @endif
                                    @if($taskRunning->importance == 1)
                                        <div class="w-4 h-4 rounded-full bg-warning"></div>
                                        <p class="text-md ml-2">
                                            Средний приоритет
                                        </p>
                                    @endif
                                    @if($taskRunning->importance == 2)
                                        <div class="w-4 h-4 rounded-full bg-danger"></div>
                                        <p class="text-md ml-2">
                                            Высокий приоритет
                                        </p>
                                    @endif
                                </div>
                                <div class="align-items-center text-black text-uppercase position-relative">
                                    <p class="text-md lg:text-lg ml-2 my-2">
                                        {{\Illuminate\Support\Str::limit($taskRunning->task,30)}}
                                    </p>
                                </div>
                                <div class="my-3 pb-4 text-black text-sm">
                                    <p class="pb-2">Руководитель:</p>
                                    <a class="inline-block w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
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
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if($tasks->has(2))
                    <div class="col-12 col-lg-6 col-xl-4 p-3">
                        <div class="text-lg lg:text-xl xl:text-2xl text-center">
                            <p class="text-black font-weight-bold ml-2">
                                Выполненые задачи
                            </p>
                        </div>
                        @foreach($tasks[2] as $taskEnded)
                            <div class="card position-relative shadow-lg rounded-2xl min-h-[300px] bg-white my-3 p-4">
                                <a href="{{route("employee-task-detail",$taskEnded->id)}}">
                                    <div class="flex justify-content-between">
                                        <div class="w-1/2 border-b-[1px] border-gray-300">
                                            <p class="text-md lg:text-lg xl:text-xl text-black font-weight-bold ml-2">
                                                Задача #{{$taskEnded->id}}
                                            </p>
                                        </div>
                                        <div class="w-1/2 flex justify-content-end border-gray-300">
                                            <img src="/images/navbar-logo.png" class="max-w-[20px]"/>
                                            @if($user->id == $taskEnded->user_id)
                                                <form action="{{route('employee-task-delete',$taskEnded->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger bg-danger text-white rounded-full h-8 w-8 flex justify-content-center align-items-center mx-2">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex my-4 align-items-center text-black text-uppercase">
                                        @if($taskEnded->importance == 0)
                                            <div class="w-4 h-4 rounded-full bg-success"></div>
                                            <p class="text-md ml-2">
                                                Низкий приоритет
                                            </p>
                                        @endif
                                        @if($taskEnded->importance == 1)
                                            <div class="w-4 h-4 rounded-full bg-warning"></div>
                                            <p class="text-md ml-2">
                                                Средний приоритет
                                            </p>
                                        @endif
                                        @if($taskEnded->importance == 2)
                                            <div class="w-4 h-4 rounded-full bg-danger"></div>
                                            <p class="text-md ml-2">
                                                Высокий приоритет
                                            </p>
                                        @endif
                                    </div>
                                    <div class="align-items-center text-black text-uppercase position-relative">
                                        <p class="text-md lg:text-lg ml-2 my-2">
                                            {{\Illuminate\Support\Str::limit($taskEnded->task,30)}}
                                        </p>
                                    </div>
                                    <div class="my-3 pb-4 text-black text-sm">
                                        <p class="pb-2">Руководитель:</p>
                                        <a class="inline-block w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
                                           title="{{$taskEnded->user->name}}"
                                           style="background-image: url({{$taskEnded->user->img}})">
                                        </a>
                                        <p class="pb-2">Исполняющие сотрудники:</p>
                                        <div class="avatar-stack flex">
                                            @foreach($taskEnded->getUsers() as $activeUser)
                                                <a class="w-8 h-8 bg-no-repeat bg-cover border border-yellow-500 rounded-full"
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
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- end col -->
    @endif
</div>
