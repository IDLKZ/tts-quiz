<?php

namespace App\Http\Livewire\Directory;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class Company extends LivewireSelect
{
    public function options($searchTerm = null) : Collection
    {
        $collect = [];
        $companies = \App\Models\Company::all();
        foreach ($companies as $company) {
            $collect[$company->id]['value'] = $company->id;
            $collect[$company->id]['description'] = $company->title;
        }
        return collect($collect);
    }
}
