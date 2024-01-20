<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

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
