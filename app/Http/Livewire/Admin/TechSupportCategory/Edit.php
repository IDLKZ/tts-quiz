<?php

namespace App\Http\Livewire\Admin\TechSupportCategory;

use App\Http\Requests\LiteratureCategory\LiteratureCategoryEditRequest;
use App\Http\Requests\TechSupportCategory\TechSupportCategoryEditRequest;
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
        return (new TechSupportCategoryEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.admin.tech-support-category.edit');
    }
}
