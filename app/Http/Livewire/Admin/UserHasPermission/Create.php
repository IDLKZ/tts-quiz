<?php

namespace App\Http\Livewire\Admin\UserHasPermission;

use App\Models\Department;
use App\Models\Permission;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $departments;
    public $department_id;
    public $users = [];
    public $user_id;
    public $permissions;
    public $permission_id;

    public function mount(){
        $this->departments = Department::with("company")->get();
        $this->permissions = Permission::all();
    }

    public function updatedDepartmentId(){
        $this->users = User::where(["department_id" => $this->department_id])->get();
        $this->user_id = null;
    }


    public function render()
    {
        return view('livewire.admin.user-has-permission.create');
    }
}
