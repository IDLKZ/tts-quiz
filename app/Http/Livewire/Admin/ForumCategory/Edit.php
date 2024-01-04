<?php

namespace App\Http\Livewire\Admin\ForumCategory;

use App\Http\Requests\ForumCategory\ForumCategoryEditRequest;
use App\Http\Requests\LiteratureCategory\LiteratureCategoryEditRequest;
use Livewire\Component;

class Edit extends Component
{
    public $title;
    public $image_url;
    public $category;

    public function mount($category){
        $this->category = $category;
        $this->title = $category->title;
    }
    protected function rules(){
        return (new ForumCategoryEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.admin.forum-category.edit');
    }
}
