<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Directory\Department;
use App\Http\Requests\Course\CourseCreateRequest;
use App\Models\Company;
use Livewire\Component;

class CourseCreate extends Component
{
    public $title;
    public $subtitle;
    public $description;
    public $image_url;
    public $companies;
    public $companies_list;
    public $departments;
    public $departments_list;


    public function mount(){
        $this->departments_list = \App\Models\Department::with(["company"])->get();
        $this->title = old("title") ?? "";
        $this->subtitle = old("subtitle") ?? "";
        $this->description = old("description") ?? "";
        $this->departments = old("departments");
        $this->companies = old("companies");;
    }
    protected function rules(){
        return (new CourseCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.course-create');
    }
}
