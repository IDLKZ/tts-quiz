<?php

namespace App\Http\Livewire\Admin\Task;

use App\Http\Requests\Task\TaskCreateRequest;
use App\Http\Requests\Task\TaskEditRequest;
use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $task;
    public $taskActive;
    public $details;
    public $users = [];
    public $selectedUsers;
    public $user_id;
    public $importance;
    public $status;
    public $start_date;
    public $end_date;
    public $departments;
    public $department_id;

    public function mount(Task $taskActive){
        $this->taskActive = $taskActive;
        $this->departments = Department::with(["company"])->get();
        $this->task = $taskActive->task;
        $this->users = $taskActive->users;
        $this->details = $taskActive->details;
        $this->user_id = $taskActive->user_id;
        $this->importance = $taskActive->importance;
        $this->status = $taskActive->status;
        $this->department_id =$taskActive->department_id;
        $this->start_date = $taskActive->start_date->format("d/m/Y H:i");
        $this->end_date = $taskActive->end_date ? $taskActive->end_date->format("d/m/Y H:i") : null;
        $this->selectedUsers = User::where(["department_id" => $this->department_id])->get();
    }
    protected function rules(){
        return (new TaskEditRequest())->rules();
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
        return view('livewire.admin.task.edit');
    }
}
