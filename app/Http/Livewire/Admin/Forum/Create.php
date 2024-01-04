<?php

namespace App\Http\Livewire\Admin\Forum;

use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Forum\ForumCreateRequest;
use App\Models\CategoriesForum;
use Livewire\Component;

class Create extends Component
{
    public $title;
    public $category_id;
    public $description;
    public $departments;
    public $categories;
    public $departments_list;


    public function mount(){
        $this->departments_list = \App\Models\Department::with(["company"])->get();
        $this->categories = CategoriesForum::all();
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
        return view('livewire.admin.forum.create');
    }
}
