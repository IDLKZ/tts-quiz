<?php

namespace App\Http\Livewire\Admin;

use App\Exports\TicketExport;
use App\Models\TicketCategory;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ticket;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TicketTable extends DataTableComponent
{
    protected $model = Ticket::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([20, 50, 100]);
        $this->setPerPage(20);
        $this->setBulkActions([
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ]);
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('ticket.show', $row);
            });
    }
    public function deleteSelected()
    {
        $model = $this->getSelected();
        foreach ($model as $key => $value) {
            $entity = Ticket::find($value);
            if($entity){
                $entity->delete();
            }
        }
        $this->clearSelected();
    }
    public function filters(): array
    {
        return [
            SelectFilter::make("Категория")
                ->options(TicketCategory::pluck("title","id")->toArray())
                ->filter(function($builder, string $value) {
                    return $builder->where(["category_id"=>$value]);
                }),
            SelectFilter::make("Решен ли вопрос")
                ->options(["true"=>"Решен","false"=>"Не решен"])
                ->filter(function($builder, string $value) {
                    return $builder->where(["is_resolved"=>$value]);
                }),
            SelectFilter::make("Дан ли отвен на вопрос")
                ->options(["true"=>"Да","false"=>"Нет"])
                ->filter(function($builder, string $value) {
                    return $builder->where(["is_answered"=>$value]);
                }),
        ];
    }
    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
            'deleteSelected' => 'Удалить'
        ];
    }
    public function exportSelected(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $model = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new TicketExport($model), 'tickets.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable(),
            Column::make("Категория", "category.title")
                ->sortable(),
            Column::make("Пользователь", "user.name")
                ->sortable(),
            Column::make("Наименование", "title")
                ->sortable(),
            Column::make("Описание", "description")
                ->searchable(),
            BooleanColumn::make("Отвечен", "is_answered")
                ->sortable(),
            BooleanColumn::make("Решен", "is_resolved")
                ->sortable(),
            Column::make("Создан", "created_at")
                ->sortable(),
            Column::make("Обновлен", "updated_at")
                ->sortable(),
        ];
    }
}
