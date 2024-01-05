<?php

namespace App\Http\Livewire\Employee\Task;

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
        $this->taskReport = TaskReport::where(["task_id" => $this->taskId,"user_id" => $this->user->id,"status" => $this->task->status])->first();
    }

    public function completeLevel(){
        if(!TaskReport::where(["task_id" => $this->taskId,"user_id" => $this->user->id,"status" => $this->task->status])->exists() && in_array($this->user->id,$this->task->users) && $this->task->status < 2){
            TaskReport::add(["task_id"=>$this->taskId,"user_id"=>$this->user->id,"status"=>$this->task->status,"is_ready"=>true]);
            if(TaskReport::where(["task_id"=>$this->taskId,"status"=>$this->task->status,"is_ready"=>true])->count("id") == count($this->task->users)){
                $this->task->edit(["status"=>$this->task->status + 1]);
            }
            $this->ready = false;
            $this->getTask();
            $this->taskReports();
        }
    }

    public function getTask(){
        $task = Task::with(["department","user"])
            ->whereJsonContains("users",$this->user->id)->where(["id"=>$this->taskId])->orWhere(["user_id" => $this->user->id])
            ->first();
    }

    public function render()
    {
        $this->getTask();
        return view('livewire.employee.task.show');
    }
}
