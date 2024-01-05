<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Task;
use App\Models\TaskReport;
use Livewire\Component;

class Show extends Component
{
    public $task;
    public $taskId;
    public $taskReports;
    public $ready = false;
    public $taskReport;

    public $user;

    public function mount($task){
        $this->user = auth()->user();
        $this->task = $task;
        $this->taskId = $task->id;
        $this->taskReports();
    }

    public function taskReports(){
        $this->taskReports = collect(TaskReport::where(["task_id"=>$this->taskId])->with(["user.department"])->get()->groupBy("status"));
    }


    public function getTask(){
        $task = Task::with(["department","user"])
            ->whereJsonContains("users",$this->user->id)->where(["id"=>$this->taskId])
            ->first();
    }

    public function render()
    {
        $this->getTask();
        return view('livewire.admin.task.show');
    }
}
