<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;

class Create extends Component
{
    public $name;

    public function mount(){
        $this->name = old("name");
    }

    public function render()
    {
        return view('livewire.admin.permission.create');
    }
}
