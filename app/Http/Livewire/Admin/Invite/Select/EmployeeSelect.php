<?php

namespace App\Http\Livewire\Admin\Invite\Select;

use App\Models\User;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class EmployeeSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        $companyList = [];
        $collect = [];
        $employees = User::where('role_id', 2)->get();
        foreach ($employees as $employee) {
            $companyList[$employee->department_id][$employee->id]['value'] = $employee->id;
            $companyList[$employee->department_id][$employee->id]['description'] = $employee->name;
        }
        $companyID = $this->getDependingValue('department_id');
        if ($this->hasDependency('department_id') && $companyID != null) {
            return collect(data_get($companyList, $companyID, []));
        }
        return collect($collect);
    }
}
