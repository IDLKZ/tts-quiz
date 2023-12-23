<?php

namespace App\Http\Livewire\Admin\Document;

use App\Http\Requests\Document\DocumentEditRequest;
use App\Models\DocumentCategory;
use App\Models\LiteratureCategory;
use Livewire\Component;

class Edit extends Component
{
    public $document;
    public $categories;
    public $category_id;
    public $title;
    public $description;
    public $image_url;

    public function mount($document){
        $this->document = $document;
        $this->categories = DocumentCategory::all();
        $this->category_id = $document->category_id;
        $this->title = $document->title;
        $this->description =$document->description;
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
        return view('livewire.admin.document.edit');
    }
}
