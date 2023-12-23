<?php

namespace App\Http\Livewire\Admin\Literature;

use App\Http\Requests\Literature\DocumentCreateRequest;
use App\Http\Requests\Literature\DocumentEditRequest;
use App\Models\LiteratureCategory;
use Livewire\Component;

class Edit extends Component
{
    public $literature;
    public $categories;
    public $category_id;
    public $title;
    public $description;
    public $image_url;

    public function mount($literature){
        $this->literature = $literature;
        $this->categories = LiteratureCategory::all();
        $this->category_id = $literature->category_id;
        $this->title = $literature->title;
        $this->description =$literature->description;
    }
    protected function rules(){
        return (new DocumentEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.admin.literature.edit');
    }
}
