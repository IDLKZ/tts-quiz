<?php

namespace App\Http\Livewire\Admin\Literature;

use App\Http\Requests\Event\EventEditRequest;
use App\Http\Requests\Literature\DocumentCreateRequest;
use App\Models\Event;
use App\Models\LiteratureCategory;
use Livewire\Component;

class Create extends Component
{
    public $categories;
    public $category_id;
    public $title;
    public $description;
    public $image_url;

    public function mount(){
        $this->categories = LiteratureCategory::all();
        $this->category_id = old("category_id");
        $this->title = old("title");
        $this->description = old("description");
    }
    protected function rules(){
        return (new DocumentCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.admin.literature.create');
    }
}
