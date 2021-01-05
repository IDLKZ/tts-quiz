<div>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Наименование</label>
            <div class="col-md-10">
                <input class="form-control " wire:model="title" type="text" value="{{old("title")}}" id="example-text-input">
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Компания</label>
            <div class="col-md-10">
                <livewire:admin.invite.select.company-select
                    name="company_id"
                placeholder="Выберите компанию"
                />
                @error('company_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Отдел</label>
            <div class="col-md-10">
                <livewire:admin.invite.select.department-select
                    name="department_id"
                    placeholder="Выберите отдел"
                    :depends-on="['company_id']"/>
                @error('department_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Сотрудник</label>
            <div class="col-md-10">
                <livewire:admin.invite.select.employee-select
                    name="user_id"
                    placeholder="Выберите сотрудника"
                    :depends-on="['department_id']"/>
                @error('user_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Тип теста</label>
            <div class="col-md-10">
                <select wire:model="type_id" class="form-control">
                    <option>Не выбрано</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->title}}</option>
                    @endforeach
                </select>
                @error('type_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-date-input" class="col-md-2 col-form-label">Начало</label>
            <div class="col-md-10">
                <input wire:model="start" class="form-control" value="{{\Illuminate\Support\Carbon::now()->format('Y.m.d')}}" type="date" id="example-date-input">
                @error('start') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="example-date-input" class="col-md-2 col-form-label">Конец</label>
            <div class="col-md-10">
                <input wire:model="end" class="form-control" type="date" id="example-date-input">
                @error('end') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-info">Отправить</button>

        </div>
    </form>
</div>
