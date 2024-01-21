<?php

namespace App\Http\Livewire\Employee\Schedule;

use App\Http\Requests\Schedule\ScheduleEditRequest;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $schedule;
    public $departments;
    public $department_id;
    public $title;
    public $description;
    public $users;
    public $user_id;
    public $start_at;
    public $end_at;


    public function mount(Schedule $schedule){
        $this->schedule = $schedule;
        $this->departments = Department::where(["id"=>auth()->user()->department_id])->with("company")->get();
        $this->department_id = $this->schedule->user->department_id;
        if($this->department_id){
            $this->users = User::where(["department_id" => $this->department_id,"id"=>auth()->id()])->get();
            $this->user_id = auth()->id();
        }
        $this->title = $this->schedule->title;
        $this->description = $this->schedule->description;
        $this->start_at = $schedule->start_at->format("d/m/Y H:i");
        $this->end_at = $schedule->end_at->format("d/m/Y H:i");
    }

    public function selectDepartment(){
        $this->departments = Department::where(["id"=>auth()->user()->department_id])->with("company")->get();
        if($this->department_id){
            $this->users = User::where(["department_id" => $this->department_id,"id"=>auth()->id()])->get();
            $this->user_id = auth()->id();
        }
    }

    protected function rules(){
        return (new ScheduleEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.employee.schedule.edit');
    }
}
