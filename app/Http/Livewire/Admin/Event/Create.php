<?php

namespace App\Http\Livewire\Admin\Event;

use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Event\EventCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public $title;
    public $description;
    public $image_url;
    public $address;
    public $start_date;
    public $end_date;


    public function mount(){
        $this->title = old("title") ?? "";
        $this->description = old("description") ?? "";
        $this->address = old("address");
        $this->start_date = old("start_date");
        $this->end_date = old("end_date");
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
        return view('livewire.admin.event.create');
    }
}
