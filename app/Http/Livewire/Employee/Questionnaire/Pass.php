<?php

namespace App\Http\Livewire\Employee\Questionnaire;

use App\Models\Questionnaire;
use App\Models\QuestionnaireQuestion;
use Livewire\Component;

class Pass extends Component
{
    public $questionnaire;
    public $questions;
    public $max_answer;
    public $given_answer = 0;
    public $answers = [];
    public $text_answers = [];
    public $must_given_answers = [];
    public $given_answers = [];

    public function mount($questionnaire, $questions)
    {
        $this->questionnaire = $questionnaire;
        $this->questions = $questions;
        foreach ($this->questions as $question){
            $this->max_answer += $question->max_answer;
            array_push($this->must_given_answers,$question->id);
        }

    }

    public function checkAnswer()
    {
        $this->given_answer=0;
        foreach ($this->answers as $questionId => $answers){
            foreach ($answers as $answerID => $answerVALUE){
                if(!$answerVALUE){
                    unset($this->answers[$questionId][$answerID]);
                    if(count($this->answers[$questionId]) == 0){
                        unset($this->answers[$questionId]);
                    }
                }
            }
        }
        foreach ($this->answers as $questionId => $answers){
            $this->given_answer += count($answers);
        }
    }

    public function updatedTextAnswers()
    {
        foreach ($this->text_answers as $questionId => $answer){
            if(!$answer) {
                unset($this->text_answers[$questionId]);
            }
        }
    }


    public function render()
    {
        foreach ($this->text_answers as $questionID => $value){
            array_push($this->given_answers,$questionID);
        }
        return view('livewire.employee.questionnaire.pass');
    }
}
