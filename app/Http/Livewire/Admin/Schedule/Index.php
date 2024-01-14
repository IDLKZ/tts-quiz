<?php

namespace App\Http\Livewire\Admin\Schedule;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        return view('livewire.admin.schedule.index');
    }
}
