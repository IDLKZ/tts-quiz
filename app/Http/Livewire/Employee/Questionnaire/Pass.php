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

    public function mount($questionnaire, $questions)
    {
        $this->questionnaire = $questionnaire;
        $this->questions = $questions;
        foreach ($this->questions as $question){
            $this->max_answer += $question->max_answer;
        }
    }

    public function checkAnswer()
    {
        $this->given_answer=0;
        foreach ($this->answers as $questionId => $answers){
            foreach ($answers as $answerID => $answerVALUE){
                if(!$answerVALUE){
                    unset($this->answers[$questionId][$answerID]);
                }
            }
        }
        foreach ($this->answers as $questionId => $answers){
            $this->given_answer += count($answers);
        }
    }

    public function render()
    {
        return view('livewire.employee.questionnaire.pass');
    }
}
