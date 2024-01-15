<?php

namespace App\Http\Livewire\Employee;

use App\Models\Schedule;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Livewire\Component;

class EmployeeSchedule extends LivewireCalendar
{
    public function events() : \Illuminate\Support\Collection
    {
        return Schedule::query()
            ->where(["user_id" => auth()->id()])
            ->with(["user.department"])
            ->whereDate('start_at', '>=', $this->gridStartsAt)
            ->whereDate('start_at', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (Schedule $model) {
                return [
                    'id' => $model->id,
                    'title' => $model->title,
                    'description' => "У сотрудника " . $model->user->name . " департамента " . $model->user->department->title,
                    'date' => $model->start_at,
                ];
            });
    }

    public function onEventClick($eventId)
    {
        $this->redirect(route("employee-schedule-show",$eventId));
    }

}
