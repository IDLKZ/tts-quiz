<div class="container">
    <div class="grid grid-cols-12">
        <div class="col-span-12">

            <livewire:appointments-calendar
                year="{{\Illuminate\Support\Carbon::now()->year}}"
                month="12"
            />

        </div>
    </div>

</div>
