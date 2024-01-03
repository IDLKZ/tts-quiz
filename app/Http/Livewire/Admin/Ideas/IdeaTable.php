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
            Column::make("Title", "title")
                ->sortable(),
            Column::make("Image url", "image_url")
                ->sortable(),
            Column::make("User id", "user.name")
                ->sortable(),
            Column::make("File url", "file_url")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Opinion", "opinion")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
