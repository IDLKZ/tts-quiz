<?php

namespace App\Http\Livewire\Admin\Questionnaire;

use App\Http\Requests\QuestionnaireCreateRequest;
use App\Http\Requests\QuestionnaireEditRequest;
use App\Models\Department;
use App\Models\Questionnaire;
use Livewire\Component;

class Edit extends Component
{
    public $questionnaire;
    public $image_url;
    public $title;
    public $description;
    public $departments;
    public $departmentLists;
    public $start_at;
    public $end_at;

    public function mount(Questionnaire $questionnaire){
        $this->questionnaire = $questionnaire;
        $this->departmentLists = Department::all();
        $this->title = $questionnaire->title;
        $this->description = $questionnaire->description;
        $this->departments = json_decode($questionnaire->departments);
        $this->start_at = $questionnaire->start_at->format("d/m/Y H:i");
        $this->end_at = $questionnaire->end_at->format("d/m/Y H:i");
    }
    protected function rules(){
        return (new QuestionnaireEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.admin.questionnaire.edit');
    }
}
