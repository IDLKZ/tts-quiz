<?php

namespace App\Http\Livewire\Employee\Schedule;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public $yearId;
    public $monthId;
    public $years = [];
    public $months = [
        1 => "Январь",
        2 => "Февраль",
        3 => "Март",
        4 => "Апрель",
        5 => "Май",
        6 => "Июнь",
        7 => "Июль",
        8 => "Август",
        9 => "Сентябрь",
        10 => "Октябрь",
        11 => "Ноябрь",
        12 => "Декабрь"
    ];

    public function mount(){
        for ($i = Carbon::today()->year - 3; $i <= Carbon::today()->year + 5; $i++){
            array_push($this->years,$i);
        }
        $this->yearId = Session::has("yearId") ? Session::get("yearId") : Carbon::today()->year;
        $this->monthId = Session::has("monthId") ? Session::get("monthId") : Carbon::today()->month;
    }

    public function selectMonth(){
        Session::put("monthId",$this->monthId);
        $this->redirect(route("employee-schedules"));
    }
    public function selectYear(){
        Session::put("yearId",$this->yearId);
        $this->redirect(route("employee-schedules"));
    }
    public function render()
    {
        return view('livewire.employee.schedule.index');
    }
}
