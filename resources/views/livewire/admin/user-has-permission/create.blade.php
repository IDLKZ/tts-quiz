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
    <div class="col-12 bg-white shadow-lg rounded-lg p-3 min-vh-100">
        <form id="js-form" action="{{route("user-has-permission.store")}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-3">
                <x-select
                    label="Выберите департамент"
                    placeholder="Выберите департамент чтобы показать список сотрудников"
                    :options="$departments"
                    option-label="title"
                    option-value="id"
                    wire:model="department_id"
                />
            </div>
                <div class="form-group my-3">
                    <x-select
                        label="Выберите сотрудника"
                        :options="$users"
                        option-label="name"
                        option-value="id"
                        wire:model="user_id"
                    />
                </div>
            <div class="form-group my-3">
                <x-select
                    label="Выберите разрешение"
                    :options="$permissions"
                    option-label="name"
                    option-value="id"
                    wire:model="permission_id"
                />
            </div>
            <div class="text-right">
                <button class="btn btn-success text-white">
                    Создать
                </button>
            </div>
        </form>
    </div>

</div>



