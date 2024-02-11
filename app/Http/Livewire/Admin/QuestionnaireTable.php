<?php

namespace App\Http\Livewire\Admin;

use App\Models\UserHasPermission;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Questionnaire;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class QuestionnaireTable extends DataTableComponent
{
    protected $model = Questionnaire::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,40,80,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('questionnaire.edit', $row);
            });
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Удалить'
        ];
    }


    public function deleteSelected(): void
    {
        $items = $this->getSelected();
        foreach ($items as $key => $value) {
            $model = Questionnaire::find($value);
            if($model){
                $model->delete();
            }
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", "title")
                ->searchable(),
            Column::make("Начало", "start_at")
                ->sortable(),
            Column::make("Окончание", "end_at")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            LinkColumn::make('Вопросы')
                ->title(fn($row) => '+')
                ->location(fn($row) => route('questionnaire-questions-show', $row))
                ->attributes(fn($row) => [
                    'class' => 'btn btn-info',
                ]),
            LinkColumn::make('Статистика')
                ->title(fn($row) => '%')
                ->location(fn($row) => route('questionnaire-questions-stat', $row))
                ->attributes(fn($row) => [
                    'class' => 'btn btn-info',
                ]),
        ];
    }
}
