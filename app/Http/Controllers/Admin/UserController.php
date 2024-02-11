<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereIn('role_id', [2,3])->with("department")->paginate(15);
        $departments = Department::all();
        $jsValidator = JsValidator::make(
            [
                "department_id"=>"required|exists:departments,id",
                "name"=>"required",
                "img"=>"sometimes|image|max:4096",
                'position' => 'required',
                'phone' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:4'
            ]
        );
        return view("admin.users.index",compact("users", 'departments', 'jsValidator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $roles = Role::all();
        return view("admin.user.create",compact("companies"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "role_id"=>"required|exists:roles,id",
            "department_id"=>"required|exists:departments,id",
            "name"=>"required|max:255",
            "phone"=>"required|max:255",
            "img"=>"sometimes|image|max:4096",
            "position"=>"required|max:255",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|min:4|max:255"
        ]);
            if (User::saveData($request)){
                toastSuccess('Успешно создан!');
                return redirect()->back();
            }
            else{
                toastError('Что то пошло не так!');
                return redirect()->back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(["department", 'results', 'invites'])->find($id);
        if ($user){
            return view("admin.users.show",compact("user"));
        }
        else{
            return redirect(route("user.index"));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with("department")->find($id);
        $jsValidator = JsValidator::make(
            [
                "department_id"=>"required|exists:departments,id",
                "name"=>"required",
                "img"=>"sometimes|image|max:4096",
                'position' => 'required',
                'phone' => 'required',
                'password' => 'sometimes|min:4'
            ]
        );
        $departments = Department::all();
        if ($user){
            return  view("admin.users.edit",compact("user","departments", 'jsValidator'));
        }
        else{
            return  redirect(route("user.index"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::with("department")->find($id);
        if($user){
            $this->validate($request,["role_id"=>"required|exists:roles,id","department_id"=>"required|exists:departments,id", "name"=>"required|max:255","phone"=>"required|max:255","img"=>"sometimes|image|max:4096","position"=>"required|max:255","email"=>"required|email|unique:users,email,".$id, "password"=>"sometimes|nullable|min:4|max:255"]);
            if(User::updateData($request,$user)){
                toastSuccess('Успешно обновлен!');
                return redirect(route('user.index'));
            }
            else{
                toastError('Что то пошло не так!');
                return redirect()->back();
            }
        }
        else{
            toastError('Что то пошло не так!');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user){
            Auth::id() != $id ? $user->delete() : null;
        }
        return  redirect(route("user.index"));
    }

    public function excel(){
        $departments = Department::with("company")->get();
        return view("admin.users.excel",compact("departments"));
    }

    public function uploadExcel(Request $request){
        $this->validate($request,["department_id"=>"required","excel"=>"required|file"]);
         $mails = User::get()->pluck("email")->toArray();
             if((in_array($request->file("excel")->getClientOriginalExtension(),["xls","xlsx"]))){
                 Excel::import(new UsersImport($mails,$request->department_id,$request->boolean("candidate")), $request->file("excel"));
                 toastr()->success("Проведен экспорт пользователей");
             }
             else{
                 toastr()->error("Загрузите EXCEL файл");
             }

            return redirect()->back();
    }
}
