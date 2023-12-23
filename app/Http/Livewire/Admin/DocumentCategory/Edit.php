<?php

namespace App\Http\Livewire\Admin\DocumentCategory;

use App\Http\Requests\LiteratureCategory\LiteratureCategoryEditRequest;
use Livewire\Component;

class Edit extends Component
{
    public $title;
    public $category;

    public function mount($category){
        $this->category = $category;
        $this->title = $category->title;
    }
    protected function rules(){
        return (new LiteratureCategoryEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.admin.document-category.edit');
    }
}
