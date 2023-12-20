<?php

namespace App\Http\Livewire\Admin\Question;

use App\Http\Requests\Question\QuestionCreateRequest;
use App\Http\Requests\Question\QuestionEditRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use Livewire\Component;

class Edit extends Component
{
    public $text;
    public $courses;
    public $lessons;
    public $course_id;
    public $context;
    public $lesson_id;
    public $question;
    public $correct_answer;
    public $a;
    public $b;
    public $c;
    public $d;
    public $e;
    public $f;
    public $g;
    public $h;




    public function mount(Question $question){
        $this->question = $question;
        $this->lessons = Lesson::where(["id"=>$question->lesson_id])->get();
        $lesson = Lesson::where(["id"=>$question->lesson_id])->first();
        $this->courses = Course::all();
        $this->course_id = $lesson ? $lesson->course_id : null;
        $this->text = $question->text;
        $this->context = $question->context;
        $this->lesson_id = $question->lesson_id;
        $this->correct_answer = $question->correct_answer;
        $this->a = $question->a;
        $this->b =$question->b;
        $this->c = $question->c;
        $this->d = $question->d;
        $this->e = $question->e;
        $this->f = $question->f;
        $this->g = $question->g;
        $this->h = $question->h;

    }
    protected function rules(){
        return (new QuestionEditRequest())->rules();
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
        return view('livewire.admin.question.edit');
    }
}
