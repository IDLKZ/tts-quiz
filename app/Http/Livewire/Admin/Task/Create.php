<?php

namespace App\Http\Livewire\Admin\Task;

use App\Http\Requests\Task\TaskCreateRequest;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $task;
    public $details;
    public $users;
    public $selectedUsers;
    public $user_id;
    public $importance;
    public $status;
    public $start_date;
    public $end_date;
    public $departments;
    public $department_id;

    public function mount(){
        $this->departments = Department::with(["company"])->get();
        $this->task = old("task");
        $this->details = old("details");
        $this->user_id = old("user_id");
        $this->importance = old("importance");
        $this->status = old("status");
        $this->department_id = old("department_id");

    }
    protected function rules(){
        return (new TaskCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function selectDepartment(){
        if($this->department_id){
            $this->selectedUsers = User::where(["department_id" => $this->department_id])->get();
        }
        else{
            $this->selectedUsers = null;
            $this->user_id = null;
            $this->users = null;
        }
    }


    public function render()
    {
        return view('livewire.admin.task.create');
    }
}
