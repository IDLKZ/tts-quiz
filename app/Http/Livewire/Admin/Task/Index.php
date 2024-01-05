<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $tasks;
    public $user;
    public $status;
    public $start_at;
    public $start_at_input;
    public $end_at;
    public $end_at_input;

    public function mount(){
        $this->user = Auth::user();
        $this->start_at = Carbon::now()->addDays(-7)->startOfDay();
        $this->end_at = Carbon::now()->addDays(7)->startOfDay();
        $this->changeTask();

    }

    public function changeStart(){
        $this->start_at = Carbon::parse($this->start_at_input);
        $this->changeTask();
    }

    public function changeEnd(){
        $this->end_at = Carbon::parse($this->end_at_input);
        $this->changeTask();
    }

    public function render()
    {
        $this->changeTask();
        return view('livewire.admin.task.index');
    }

    public function changeTask(){
        $this->tasks = collect(Task::with(["department","user"])
            ->where(function (Builder $query) {
                if($this->status != null){
                    $query->where(["status" => $this->status]);
                }
            })
            ->whereBetween("start_date",[$this->start_at,$this->end_at])
            ->get()->groupBy("status"));
    }
}
