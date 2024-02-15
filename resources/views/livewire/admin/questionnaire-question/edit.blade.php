<div class="row border border-gray-200 p-3 bg-white">
    <div class="col-12 text-center py-5">

            <div class="form-group w-full my-2 flex justify-center items-center w-full">
                <div>
                    <label for="confirmationDelete" class="text-rose-500">Чтобы очистить данные введите 1234</label>
                    <input wire:model="confirmationDelete" type="number" class="form-control flex max-w-[300px]" id="confirmationDelete">
                </div>

            </div>

        @if($confirmationDelete == "1234")
            <a wire:click="clearResult()" class="btn btn-danger text-white">
                Очистить результаты
            </a>
        @endif

    </div>
</div>
