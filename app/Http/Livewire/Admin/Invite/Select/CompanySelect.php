<?php

namespace App\Http\Livewire\Admin\Invite\Select;

use App\Models\Company;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class CompanySelect extends LivewireSelect
{
    public function options($searchTerm = null) : Collection
    {
        $collect = [];
        $companies = Company::all();
        foreach ($companies as $company) {
            $collect[$company->id]['value'] = $company->id;
            $collect[$company->id]['description'] = $company->title;
        }
        return collect($collect);
    }

}
