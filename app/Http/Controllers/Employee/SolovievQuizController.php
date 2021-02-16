<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Mail\InviteMail;
use App\Mail\PassMail;
use App\Models\Email;
use App\Models\Invite;
use App\Models\Job;
use App\Models\Result;
use App\Models\SolovievQuestion;
use App\Models\SolovievTest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SolovievQuizController extends Controller
{
    public function show($id){
        $results = Auth::user()->results()->pluck("invites_id")->toArray();
        $invite = Invite::where('start', '<=', \Illuminate\Support\Carbon::now())->where('end', '>=', Carbon::now())->where(function ($q){$q->where("user_id",Auth::id());$q->orWhere("department_id",Auth::user()->department_id);})->where(["status"=>0,"type_id"=>1])->with(["department","user","type"])->whereNotIn("id",$results)->find($id);
        $soloviev_quiz = SolovievTest::find(1);
        if($invite){
            if($invite->user_id == Auth::id() || $invite->department_id == Auth::user()->department_id){
                if($invite->start <= Carbon::now() && $invite->end >= Carbon::now()){
                    return view("employee.soloviev.show",compact("invite","soloviev_quiz"));
                }
            }
            abort(404);
        }
        abort(404);

    }


    public function pass($id){
        $results = Auth::user()->results()->pluck("invites_id")->toArray();
        $invite = Invite::where('start', '<=', \Illuminate\Support\Carbon::now())->where('end', '>=', Carbon::now())->where(function ($q){$q->where("user_id",Auth::id());$q->orWhere("department_id",Auth::user()->department_id);})->where(["status"=>0,"type_id"=>1])->with(["department","user","type"])->whereNotIn("id",$results)->find($id);
        $soloviev_quiz = SolovievTest::find(1);
        $soloviev_questions = SolovievQuestion::with(["solovievTest","testType"])->get();
        $jobs = Job::all();
        if($invite){
                    return view("employee.soloviev.pass",compact("soloviev_questions","soloviev_quiz","invite","jobs"));
        }
        abort(404);
    }


    public function check(Request $request){
        $answer = json_decode($request->get("oven_answer"));
        $input = $request->except("oven_answer");
        $input["oven_answer"] = $answer;
            $validator = Validator::make($input, ["answer"=>"required|size:2","answer.2"=>"required|size:10","answer.3"=>"required|size:1", "oven_answer"=>"required|size:10","job_id"=>"required|exists:jobs,id"]);
        if ($validator->passes()) {
            if(Result::checkSoloviev($input)){
                $emails = Email::pluck("email")->toArray();
                $result = Result::where(["invites_id"=>$request->get("invite"),"user_id"=>Auth::id()])->first();
                if($emails && $result){
                    Mail::to($emails)->send(new PassMail($result));
                }
                toastSuccess("Тест успешно сдан");
            }
            else{
                toastError("Упс что-то пошло не так попробуйте позже","Упс");
            }
            return redirect("/employee");
            }
        else {
            return redirect()->back()->withErrors($validator->errors()->all());
        }

    }
}
