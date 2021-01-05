<?php

namespace App\Http\Livewire\Admin\Invite\Select;

use App\Models\Company;
use App\Models\Department;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class DepartmentSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        $companyList = [];
        $collect = [];
        $departments = Department::all();
        foreach ($departments as $department) {
            $companyList[$department->company->id][$department->id]['value'] = $department->id;
            $companyList[$department->company->id][$department->id]['description'] = $department->title;
        }
        $companyID = $this->getDependingValue('company_id');
        if ($this->hasDependency('company_id') && $companyID != null) {
            return collect(data_get($companyList, $companyID, []));
        }
        return collect($collect);
    }
}
