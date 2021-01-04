<?php

namespace App\Http\Livewire\Admin\Invite;

use App\Models\Company;
use App\Models\Department;
use App\Models\Type;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $companies;
    public $types;
    public $departments = [];
    public $employees = [];

    public $title;
    public $company_id;
    public $department_id;
    public $user_id;
    public $type_id;
    public $start;
    public $end;

    protected $rules = [
        "title"=>"required|max:255",
        'company_id' => 'required|exists:companies,id',
        "department_id"=>"required|exists:departments,id",
        "user_id"=>"required|exists:users,id",
        "type_id"=>"required|exists:types,id",
        "start"=>"required",
        "end"=>"required"
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->companies = Company::has("departments",">=",1)->get();
        $this->types = Type::all();
    }
    public function render()
    {
        return view('livewire.admin.invite.create');
    }

    public function getDepartment($id)
    {
        $this->departments = Department::where('company_id', $id)->get();
        $this->employees = [];
    }

    public function getEmployee($id)
    {
        $this->employees = User::where('department_id', $id)->get();
    }

    public function submit()
    {
        $request = $this->validate();
        if(\App\Models\Invite::saveData($request)){
            toastSuccess("Успешно создано приглашение","Выполнено");
            return redirect(route('invite.index'));
        }
        else{
            toastWarning("Что-то пошло не так","Упс");
            return redirect(route('invite.index'));
        }
    }

}
