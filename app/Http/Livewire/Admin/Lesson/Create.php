<?php

namespace App\Http\Livewire\Admin\Lesson;

use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Lesson\LessonCreateRequest;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class Create extends Component
{

    public $courses;
    public $lessons;
    public $course_id;
    public $type;
    public $video_url;
    public $video;
    public $title;
    public $subtitle;
    public $description;
    public $image_url;
    public $order;
    public $prev_id;
    public $next_id;



    public function mount(){
        $this->courses = Course::all();
        $this->course_id = old("course_id");
        $this->video_url = old("video_url");
        $this->type = old("type");
        $this->title = old("title");
        $this->subtitle = old("subtitle");
        $this->description = old("description");
        $this->order = old("order");
        $this->prev_id = old("prev_id");
        $this->next_id = old("next_id");

    }
    protected function rules(){
        return (new LessonCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function selectCourse(){
       if($this->course_id){
           $this->lessons = Lesson::where(["course_id" => $this->course_id])->with("course")->get();
       }
       else{
           $this->lessons = null;
           $this->prev_id = null;
           $this->next_id = null;
       }
    }

    public function render()
    {
        return view('livewire.admin.lesson.create');
    }
}
