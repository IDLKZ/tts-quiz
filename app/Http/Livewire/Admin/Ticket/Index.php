<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $is_resolved = false;
    public $categories_ids = [];
    public $categories;

    public function mount(){
        $this->categories = TicketCategory::all();
        $this->categories_ids = TicketCategory::pluck("id")->toArray();
    }


    public function render()
    {
        return view('livewire.admin.ticket.index',[
            "tickets" => Ticket::with(["user","category"])
                ->whereIn("category_id",$this->categories_ids)
                ->withCount("ticket_messages")->where(["is_resolved" => $this->is_resolved])
                ->orderBy("updated_at","desc")
                ->paginate(20)
        ]);
    }
}
