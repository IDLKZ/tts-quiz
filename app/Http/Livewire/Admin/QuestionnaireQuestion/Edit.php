<?php

namespace App\Http\Livewire\Admin\QuestionnaireQuestion;

use App\Models\QuestionnaireResult;
use Livewire\Component;

class Edit extends Component
{
    public $confirmationDelete;
    public function clearResult()
    {
        QuestionnaireResult::truncate();
        redirect()->route("questionnaire.index");
    }

    public function render()
    {
        return view('livewire.admin.questionnaire-question.edit');
    }
}
