<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function settings()
    {
        $jsValidator = JsValidator::make(
            [
                "name"=>"required",
                "img"=>"sometimes|image|max:4096",
                'password' => 'sometimes|min:4'
            ]
        );
        return view('admin.settings', compact('jsValidator'));
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request,["role_id"=>"required|exists:roles,id", "name"=>"required|max:255","phone"=>"required|max:255","img"=>"sometimes|image|max:4096","position"=>"required|max:255","email"=>"required|email|unique:users,email,".$id, "password"=>"sometimes|nullable|min:4|max:255"]);
        $user = User::find($id);
        if(User::updateData($request,$user)){
            toastSuccess('Успешно обновлен!');
            return redirect(route('adminHome'));
        }
        else{
            toastError('Что то пошло не так!');
            return redirect()->back();
        }
    }
}
