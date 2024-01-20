<?php

namespace App\Http\Livewire\Admin\Permission;

use App\Models\Permission;
use Livewire\Component;

class Edit extends Component
{
    public $permission;
    public $name;

    public function mount(Permission $permission){
        $this->permission = $permission;
        $this->name = $permission->name;
    }

    public function render()
    {
        return view('livewire.admin.permission.edit');
    }
}
