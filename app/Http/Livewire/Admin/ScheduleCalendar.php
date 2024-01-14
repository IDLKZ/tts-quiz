<?php

namespace App\Http\Livewire\Admin;

use App\Models\Schedule;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Carbon;
use Livewire\Component;

class ScheduleCalendar extends LivewireCalendar
{
    public function events() : \Illuminate\Support\Collection
    {
        return Schedule::query()
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
        $this->redirect(route("admin-schedule.edit",$eventId));
    }

}
