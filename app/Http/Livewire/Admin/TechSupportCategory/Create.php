<?php

namespace App\Http\Livewire\Admin\TechSupportCategory;

use App\Http\Requests\LiteratureCategory\LiteratureCategoryCreateRequest;
use App\Http\Requests\TechSupportCategory\TechSupportCategoryCreateRequest;
use Livewire\Component;

class Create extends Component
{

    public function mount(){
        $this->title = old("title") ?? "";
    }
    protected function rules(){
        return (new TechSupportCategoryCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.admin.tech-support-category.create');
    }
}
