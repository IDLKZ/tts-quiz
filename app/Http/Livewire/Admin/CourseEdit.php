<?php

namespace App\Http\Livewire\Admin;

use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Course\CourseEditRequest;
use App\Models\Course;
use Livewire\Component;

class CourseEdit extends Component
{
    public $course;
    public $title;
    public $subtitle;
    public $description;
    public $image_url;
    public $companies;
    public $companies_list;
    public $departments;
    public $departments_list;


    public function mount(Course $course){
        $this->course = $course;
        $this->departments_list = \App\Models\Department::with(["company"])->get();
        $this->title = $course->title ?? "";
        $this->subtitle = $course->subtitle ?? "";
        $this->description = $course->description ?? "";
        $this->departments = $course->departments;
    }
    protected function rules(){
        return (new CourseEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.course-edit');
    }
}
