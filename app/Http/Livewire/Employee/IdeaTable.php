<?php

namespace App\Http\Livewire\Employee;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Idea;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class IdeaTable extends DataTableComponent
{
    protected $model = Idea::class;

    public function configure(): void
    {
        $this->setDefaultSort('ideas.created_at', 'desc');
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20,50,100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('employee-idea-management.edit', $row);
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
        $ideas = $this->getSelected();
        foreach ($ideas as $key => $value) {
            $idea = Idea::find($value);
            $idea->delete();
        }
        $this->clearSelected();
    }
    public function filters(): array
    {
        return [
            SelectFilter::make('Статус')
                ->options([0=>"Новая Идея",1=>"На рассмотрении",2=>"Одобрено",-1=>"Отказано"])
                ->filter(function ($builder, string $value){
                    $builder->where(['status' => $value]);
                }),
        ];
    }



    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Наименование", "title")
                ->sortable(),
            Column::make("Пользователь", "user.name")
                ->sortable(),
            Column::make('Статус',"status")
                ->format(function($value) {
                    switch ($value){
                        case 2:
                            return '<strong class="text-success">'.'Одобрено'.'</strong>';
                            break;
                        case 1:
                            return '<strong class="text-info">'.'На рассмотрении'.'</strong>';
                            break;
                        case 0:
                            return '<strong class="text-yellow-700">'.'Новая заявка'.'</strong>';
                            break;
                        case -1:
                            return '<strong class=text-red-500>'.'Отклоненно'.'</strong>';
                            break;
                    }

                })
                ->html()->searchable(),
            Column::make("Создан", "created_at")
                ->sortable(),
            Column::make("Обновлен", "updated_at")
                ->sortable(),
        ];
    }
}
