<?php

namespace App\Http\Livewire\Employee\Forum;

use App\Http\Requests\Forum\ForumCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public $title;
    public $description;
    public $departments;
    public $departments_list;


    public function mount(){
        $this->departments_list = \App\Models\Department::with(["company"])->get();
        $this->title = old("title") ?? "";
        $this->description = old("description") ?? "";
        $this->departments = old("departments");
    }
    protected function rules(){
        return (new ForumCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.employee.forum.create');
    }
}
