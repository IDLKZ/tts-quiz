<?php

namespace App\Http\Livewire\Admin\ForumCategory;

use App\Http\Requests\ForumCategory\ForumCategoryCreateRequest;
use App\Http\Requests\LiteratureCategory\LiteratureCategoryCreateRequest;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title;
    public $image_url;

    public function mount(){
        $this->title = old("title") ?? "";
    }
    protected function rules(){
        return (new ForumCategoryCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.forum-category.create');
    }
}
