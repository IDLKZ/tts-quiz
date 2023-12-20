<?php

namespace App\Http\Livewire\Admin\Event;

use App\Http\Requests\Event\EventCreateRequest;
use App\Models\Event;
use Livewire\Component;

class Edit extends Component
{
    public $event;
    public $title;
    public $description;
    public $image_url;
    public $address;
    public $start_date;
    public $end_date;


    public function mount(Event $event){
        $this->event = $event;
        $this->title = $event->title;
        $this->description =  $event->description;
        $this->address = $event->address;
        $this->start_date = $event->start_date->format("d/m/Y H:i");
        $this->end_date = $event->end_date ? $event->end_date->format("d/m/Y H:i") : null;
    }
    protected function rules(){
        return (new EventCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.admin.event.edit');
    }
}
