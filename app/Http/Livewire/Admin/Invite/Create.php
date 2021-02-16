<?php

namespace App\Http\Livewire\Admin\Invite;

use App\Models\Company;
use App\Models\Department;
use App\Models\Type;
use App\Models\User;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Create extends Component
{
    public $companies;
    public $types;
    public $departments = [];
    public $employees = [];

    public $companyTitle = 'Не выбрано';
    public $departmentTitle = 'Не выбрано';
    public $userTitle = 'Не выбрано';
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
        "user_id"=>"sometimes|nullable|exists:users,id",
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

    public function getDepartment($company)
    {
        $this->departments = Department::where('company_id', $company['id'])->get();
        $this->companyTitle = $company['title'];
        $this->departmentTitle = 'Не выбрано';
        $this->userTitle = 'Не выбрано';
        $this->employees = [];
    }

    public function getEmployee($department)
    {
        $this->employees = User::where('department_id', $department['id'])->get();
        $this->departmentTitle = $department['title'];
        $this->userTitle = 'Не выбрано';
    }

    public function setName($employee)
    {
        $this->userTitle = $employee['name'];
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

    public function render()
    {
        return view('livewire.admin.invite.create');
    }
}
