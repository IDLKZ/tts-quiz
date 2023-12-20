<?php

namespace App\Http\Livewire\Admin\Question;

use App\Http\Requests\Lesson\LessonCreateRequest;
use App\Http\Requests\Question\QuestionCreateRequest;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class Create extends Component
{
    public $text;
    public $courses;
    public $lessons;
    public $course_id;
    public $context;
    public $lesson_id;
    public $correct_answer;
    public $a;
    public $b;
    public $c;
    public $d;
    public $e;
    public $f;
    public $g;
    public $h;




    public function mount(){
        $this->courses = Course::all();
        $this->text = old("text");
        $this->context = old("context");
        $this->lesson_id = old("lesson_id");
        $this->correct_answer = old("correct_answer");
        $this->a = old("a");
        $this->b = old("b");
        $this->c = old("c");
        $this->d = old("d");
        $this->e = old("e");
        $this->f = old("f");
        $this->g = old("g");
        $this->h = old("h");

    }
    protected function rules(){
        return (new QuestionCreateRequest())->rules();
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
        }
    }
    public function render()
    {
        return view('livewire.admin.question.create');
    }
}
