<?php

namespace App\Http\Livewire\Employee\Ticket;

use App\Models\TicketMessage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManagementShow extends Component
{
    use WithFileUploads;
    public $messages;
    public $ticket;
    public $messageText = "";
    public $file;

    public function mount($ticket){
        $this->ticket = $ticket;
        $this->messages = TicketMessage::where(["ticket_id" => $ticket->id])->with("user")->orderBy("created_at","asc")->get();
    }

    public function addMessage(){
        if(strlen($this->messageText) > 0 && !$this->ticket->is_resolved){
            $message = TicketMessage::add(["user_id"=>auth()->id(),"ticket_id"=>$this->ticket->id,"message"=>$this->messageText]);
            $this->messageText = "";
            if ($this->file){
                $message->uploadFile($this->file,"file_url");
                $this->file = null;
            }
            $this->ticket->edit(["is_answered"=>true]);
            $this->ticket->is_answered = true;
            $this->messages->push($message);
            $this->emit('emptyCKEditor');
        }
    }
    public function render()
    {
        return view('livewire.employee.ticket.management-show');
    }
}
