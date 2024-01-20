<?php

namespace App\Http\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserHasPermission;

class UserHasPermissionTable extends DataTableComponent
{
    protected $model = UserHasPermission::class;

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
                return route('user-has-permission.edit', $row);
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
            $model = UserHasPermission::find($value);
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
            Column::make("Разрешение", "permission.name")
                ->sortable(),
            Column::make("Пользователь", "user.name")
                ->sortable(),
        ];
    }
}
