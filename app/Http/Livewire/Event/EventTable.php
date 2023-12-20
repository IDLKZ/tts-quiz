<?php

namespace App\Http\Livewire\Event;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class EventTable extends DataTableComponent
{
    protected $model = Event::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Изображение", "image_url")
                ->sortable(),
            Column::make("Наименование", "title")
                ->searchable(),
            Column::make("Адрес", "address")
                ->searchable(),
            Column::make("Дата начала", "start_date")
                ->sortable(),
            Column::make("Дата окончания", "end_date")
                ->sortable(),
        ];
    }

}
