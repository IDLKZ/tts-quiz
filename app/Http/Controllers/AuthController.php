<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("login");
    }

    public function auth(Request $request){
        $this->validate($request,["email"=>"required|email|max:255","password"=>"required|min:4|max:255"]);
        $credentials = $request->only(["email","password"]);
        if(Auth::attempt($credentials,$request->boolean("remember_me"))){
            if (Auth::user()->role_id == 1){
                return redirect("/admin");
            }
            else{
                return redirect("/client");
            }
        }
        else{
            return redirect()->back();
        }
    }

    public function restore(Request $request){
        $this->validate($request,["email"=>"required|email"]);
        $user = User::firstWhere("email",$request->email);

    }
}
