<?php

namespace App\Http\Livewire\Admin\LiteratureCategory;

use App\Http\Requests\Event\EventCreateRequest;
use App\Http\Requests\LiteratureCategory\LiteratureCategoryCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public $title;

    public function mount(){
        $this->title = old("title") ?? "";
    }
    protected function rules(){
        return (new LiteratureCategoryCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.admin.literature-category.create');
    }
}
