<?php

namespace App\Http\Livewire\Admin\Invite;

use App\Models\Company;
use App\Models\Department;
use App\Models\Invite;
use App\Models\Type;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $invite;
    public $boolean = false;
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
        $this->title = $this->invite->title;
        $this->start = date('Y-m-d', strtotime($this->invite->start));
        $this->end = date('Y-m-d', strtotime($this->invite->end));
        $this->company_id = $this->invite->department->company->id;
        $this->department_id = $this->invite->department_id;
        $this->user_id = $this->invite->user_id;
        $this->type_id = $this->invite->type_id;
        $this->companies = Company::has("departments",">=",1)->get();
        $this->types = Type::all();
        $this->departments = Department::where('company_id', $this->invite->department->company->id)->get();
        $this->employees = User::where('department_id', $this->invite->department_id)->get();
    }

    public function getDepartment($id)
    {
        $this->departments = Department::where('company_id', $id)->get();
        $this->employees = [];
        $this->invite->department->title = 'Не выбрано';
        $this->invite->department->id = null;
        $this->invite->user->name = 'Не выбрано';
        $this->invite->user->id = null;

    }

    public function getEmployee($id)
    {
        $this->employees = User::where('department_id', $id)->get();
        $this->invite->user->name = 'Не выбрано';
        $this->invite->user->id = null;

    }

    public function submit()
    {
        $request = $this->validate();
        if(Invite::updateData($request,$this->invite)){
            toastSuccess("Успешно обновлено","Выполнено");
            return redirect(route('invite.index'));
        }
        else{
            toastWarning("Что-то пошло не так","Упс");
            return redirect(route('invite.index'));
        }
    }

    public function hydrate()
    {
        $this->boolean = false;
    }

    public function render()
    {
        $this->boolean = true;
        return view('livewire.admin.invite.edit');
    }
}
