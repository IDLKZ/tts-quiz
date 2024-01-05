<?php

namespace App\Http\Livewire\Employee\Task;

use App\Http\Requests\Task\TaskCreateRequest;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $task;
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
    public $user;

    public function mount(){
        $this->user = auth()->user();
        $this->departments = Department::where(["id"=>$this->user->department_id])->with(["company"])->get();
        $this->selectedUsers = User::where(["department_id" => $this->user->department_id])->with(["department.company"])->get();
        $this->task = old("task");
        $this->details = old("details");
        $this->user_id = old("user_id");
        $this->importance = old("importance");
        $this->status = old("status");
        $this->users = old("users") ?? [];
        $this->department_id = $this->user->department_id;

    }
    protected function rules(){
        return (new TaskCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.employee.task.create');
    }
}
