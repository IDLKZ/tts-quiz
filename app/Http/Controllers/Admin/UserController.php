<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
        $users = User::where('role_id', 2)->with("department")->paginate(15);
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
        $user = User::with("department")->find($id);
        if ($user){
            return  view("admin.index.show",compact("user"));
        }
        else{
            return  redirect(route("user.index"));
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
                return redirect()->back();
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
}
