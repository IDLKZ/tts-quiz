<?php

namespace App\Http\Livewire\Admin\Lesson;

use App\Http\Requests\Lesson\LessonCreateRequest;
use App\Http\Requests\Lesson\LessonEditRequest;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class Edit extends Component
{
    public $lesson;
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



    public function mount(Lesson $lesson){
        $this->courses = Course::all();
        $this->course_id = $lesson->course_id;
        $this->lessons = Lesson::where(["course_id" =>  $lesson->course_id])->with("course")->get();
        $this->video_url = $lesson->video_url;
        $this->type = $lesson->type;
        $this->title = $lesson->title;
        $this->subtitle = $lesson->subtitle;
        $this->description = $lesson->description;
        $this->order = $lesson->order;
        $this->prev_id = $lesson->next_id;
        $this->next_id = $lesson->next_id;

    }
    protected function rules(){
        return (new LessonEditRequest())->rules();
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
        return view('livewire.admin.lesson.edit');
    }
}
