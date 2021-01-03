<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Proengsoft\JsValidation\Remote\Validator;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
class AuthController extends Controller
{
    public function login(){
        $jsValidator = JsValidator::make(["email"=>"required|email|max:255","password"=>"required|min:4|max:255"]);
        return view("auth.login",compact("jsValidator"));
    }

    public function auth(Request $request){
        $this->validate($request,["email"=>"required|email|max:255","password"=>"required|min:4|max:255"]);
        $credentials = $request->only(["email","password"]);
        if(Auth::attempt($credentials,$request->boolean("remember_me"))){
            if (Auth::user()->role_id == 1){
                return redirect("/admin");
            }
            else{
                return redirect("/employee");
            }
        }
        else{
            toastError("Неправильные данные для входа","Упс");
            return redirect()->back();
        }
    }

    public function forget(){
        $jsValidator = JsValidator::make([
           "email"=>"required|email|max:255"
        ]);
        return view("auth.forget");
    }


    public function restore(Request $request){
        $this->validate($request,["email"=>"required|email"]);
        $user = User::firstWhere("email",$request->email);

    }
}
