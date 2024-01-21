<?php

namespace App\Http\Livewire\Employee\Schedule;

use App\Http\Requests\Schedule\ScheduleCreateRequest;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $departments;
    public $department_id;
    public $title;
    public $description;
    public $users;
    public $user_id;
    public $start_at;
    public $end_at;


    public function mount(){
        $this->departments = Department::where(["id"=>auth()->user()->department_id])->with("company")->get();
        $this->department_id = auth()->user()->department_id;
        if($this->department_id){
            $this->users = User::where(["department_id" => $this->department_id,"id"=>auth()->id()])->get();
            $this->user_id =auth()->id();
        }
        $this->title = old("title");
        $this->description = old("description");
    }

    public function selectDepartment(){
        $this->departments = Department::where(["id"=>auth()->user()->department_id])->with("company")->get();
        if($this->department_id){
            $this->users = User::where(["department_id" => $this->department_id,"id"=>auth()->id()])->get();
            $this->user_id = auth()->id();
        }
    }

    protected function rules(){
        return (new ScheduleCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.employee.schedule.create');
    }
}
