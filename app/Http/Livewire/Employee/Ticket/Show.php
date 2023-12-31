<?php

namespace App\Http\Livewire\Employee\Ticket;

use App\Models\TicketMessage;
use Livewire\Component;

class Show extends Component
{
    public $messages;
    public $ticket;
    public $message = "";

    public function mount($ticket){
        $this->ticket = $ticket;
        $this->messages = TicketMessage::where(["ticket_id" => $ticket->id])->with("user")->orderBy("created_at","asc")->get();
    }

    public function addMessage(){
        if(strlen($this->message) > 0){
            $message = TicketMessage::add(["user_id"=>auth()->id(),"ticket_id"=>$this->ticket->id,"message"=>$this->message]);
            $this->message = "";
            $this->messages->push($message);
        }
    }

    public function render()
    {
        return view('livewire.employee.ticket.show');
    }
}
