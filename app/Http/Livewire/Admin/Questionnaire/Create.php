<?php

namespace App\Http\Livewire\Admin\Questionnaire;

use App\Http\Requests\QuestionnaireCreateRequest;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public $image_url;
    public $title;
    public $description;
    public $departments;
    public $departmentLists;
    public $start_at;
    public $end_at;

    public function mount(){
        $this->departmentLists = Department::all();
        $this->title = old("title");
        $this->description = old("description");
        $this->departments = old("departments");
        $this->start_at = old("start_at");
        $this->end_at = old("end_at");
    }
    protected function rules(){
        return (new QuestionnaireCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.questionnaire.create');
    }
}
