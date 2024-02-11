<?php

namespace App\Http\Controllers;

use App\Mail\ForgetMail;
use App\Mail\InviteMail;
use App\Models\User;
use App\Restore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3){
                return redirect("/admin");
            }
            else{
                return redirect(route('employeeMainPage'));
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
        return view("auth.forget",compact("jsValidator"));
    }


    public function restore(Request $request){
        $this->validate($request,["email"=>"required|email"]);
        $user = User::firstWhere("email",$request->email);
        if($user){
            $restore = Restore::firstWhere("user_id",$user->id);
            $restore ? $restore->delete() : null;
            $token = Str::random(12);
            Restore::create([
               "user_id"=>$user->id,
               "email"=>$user->email,
               "token"=>$token,
                "time"=>Carbon::now()->addDay()
            ]);
            Mail::to($user->email)->send(new ForgetMail($user,$token));
            toastSuccess("Ссылка для сброса пароля успешно отправлена на вашу почту","Успешно выполнено");
            return redirect(route("login"));
        }
        else{
            toastWarning("Проверьте правильность почты","Упс");
            return redirect()->back();
        }

    }

    public function recover($token){
        $restore = Restore::firstWhere("token",$token);
        if($restore){
            if($restore->time > \Illuminate\Support\Carbon::now()){
                $jsValidator = JsValidator::make([
                    "token"=>"required","password"=>"required|min:4|max:255",
                    "same_password"=>"required|min:4|max:255|same:password"
                ]);
                return view("auth.recover",compact("restore","jsValidator"));
            }
            else{
                $restore->delete();
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }

    public function newPassword(Request  $request){
        $this->validate($request,[
            "token"=>"required","password"=>"required|min:4|max:255",
            "same_password"=>"required|min:4|max:255|same:password"
        ]);
        $restore = Restore::firstWhere("token",$request->get("token"));
        if($restore){
            if($restore->time > \Illuminate\Support\Carbon::now()){
                $user = User::find($restore->user_id);
                if($user){
                    $user->password = bcrypt($request->get("password"));
                    $user->save();
                    $restore->delete();
                    toastSuccess("Успешно изменен пароль!","Выполнено!");
                    return redirect(route("login"));
                }
                else{
                    abort(404);
                }

            }
            else{
                $restore->delete();
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }
}
