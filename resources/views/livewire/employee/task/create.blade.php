
<div class="row my-2 py-4">
    <div class="col-12 my-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="col-12 bg-white shadow-lg rounded-lg p-3">
        <form id="js-form" action="{{route("employee-task-store")}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Отдел *</label>
                <div>
                    <select wire:model="department_id" class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">
                                {{$department->title}} ({{$department->company->title}})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <fieldset>
                    @foreach($selectedUsers as $selectedUser)
                        @if($selectedUser->id != $user->id)
                            <div class="flex items-center mb-2">
                                <input wire:model="users" id="{{$selectedUser->name}}{{$selectedUser->id}}" type="checkbox" value="{{$selectedUser->id}}" name="users[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="{{$selectedUser->name}}{{$selectedUser->id}}" class="m-2 text-md font-medium text-gray-900 cursor-pointer">
                                    <div class="flex align-items-center justify-content-center">
                                        <div
                                            class="flex items-center
                                                    h-10 w-10
                                                    justify-center
                                                    rounded-full flex-shrink-0
                                                    bg-center bg-no-repeat bg-cover mr-1"
                                            style="background-image:url({{$selectedUser->img}})"
                                        >
                                        </div>
                                        <p>
                                            {{$selectedUser->name}}
                                        </p>
                                    </div>

                                </label>
                            </div>
                        @endif
                    @endforeach
                </fieldset>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Задача *</label>
                <div>
                    <input  wire:model="task" class="form-control  @error('task') is-invalid @enderror" name="task" type="text" value="{{old("task")}}" >
                </div>
            </div>

            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Детали задачи *</label>
                <div wire:ignore>
                    <textarea wire:model="details" id="editor" name="details"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Важность *</label>
                <div>
                    <select class="form-control" wire:model="importance" name="importance">
                        <option value="{{null}}">
                            Выберите важность
                        </option>
                        <option value="0">
                            Низкий
                        </option>
                        <option value="1">
                            Средний
                        </option>
                        <option value="2">
                            Важный
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input" class=" col-form-label">Статус *</label>
                <div>
                    <select class="form-control" wire:model="status" name="status">
                        <option value="{{null}}">
                            Выберите важность
                        </option>
                        <option value="0">
                            К выполнению
                        </option>
                        <option value="1">
                            В процессе
                        </option>
                        <option value="2">
                            Завершены
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group"  wire:ignore>
                <label for="example-text-input" class=" col-form-label">Дата начала *</label>
                <div>
                    <input id="start_date"  wire:model="start_date" class="form-control my-date @error('start_date') is-invalid @enderror" name="start_date" type="text" value="{{old("start_date")}}" >
                </div>
            </div>
            <div class="form-group" wire:ignore>
                <label for="example-text-input" class=" col-form-label">Дата окончания *</label>
                <div>
                    <input id="end_date"  wire:model="end_date" class="form-control my-date  @error('end_date') is-invalid @enderror" name="end_date" type="text" value="{{old("end_date")}}" >
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-success text-white">
                    Создать
                </button>
            </div>
        </form>
    </div>

</div>


