<?php

namespace App\Http\Livewire\Employee\Ticket;

use App\Models\Ticket;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $is_resolved = false;

    public function render()
    {
        return view('livewire.employee.ticket.index',[
            "tickets" => Ticket::with(["user","category"])
                ->withCount("ticket_messages")->where(["user_id" => auth()->id(),"is_resolved" => $this->is_resolved])
                ->orderBy("updated_at","desc")
                ->paginate(20)
        ]);
    }
}
