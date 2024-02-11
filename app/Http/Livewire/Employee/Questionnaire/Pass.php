<?php

namespace App\Http\Livewire\Employee\Questionnaire;

use App\Models\Questionnaire;
use App\Models\QuestionnaireQuestion;
use Livewire\Component;

class Pass extends Component
{
    public $questionnaire;
    public $questions;
    public $answers = [];

    public function mount($questionnaire, $questions)
    {
        $this->questionnaire = $questionnaire;
        $this->questions = $questions;
    }

    public function render()
    {
        return view('livewire.employee.questionnaire.pass');
    }
}
