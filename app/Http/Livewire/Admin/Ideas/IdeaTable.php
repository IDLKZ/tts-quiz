<?php

namespace App\Http\Livewire\Admin\Ideas;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Idea;

class IdeaTable extends DataTableComponent
{
    protected $model = Idea::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", "title")
                ->searchable(),
            Column::make("Пользователь", "user.name")
                ->searchable(),
            Column::make('Статус', 'status')
                ->format(function ($val) {
                    switch ($val){
                        case -1:
                            '<p class="text-red-500">Отклонен</p>';
                            break;
                        case 0:
                            '<p class="text-blue-500">Новая идея</p>';
                            break;
                        case 1:
                            '<p class="text-blue-500">На рассмотрении</p>';
                            break;
                        case 2:
                            '<p class="text-green-500">Утвержден</p>';
                            break;
                    }
                })
                ->html(),
            Column::make("Мнение", "opinion")
                ->sortable(),
            Column::make("Время Создания", "created_at")
                ->sortable(),
            Column::make("Дата обновления", "updated_at")
                ->sortable(),
        ];
    }
}
