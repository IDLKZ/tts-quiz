<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\BelbinQuestion;
use App\Models\BelbinQuiz;
use App\Models\Invite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BelbinQuizController extends Controller
{
    public function show($id){
        $results = Auth::user()->results()->pluck("invites_id")->toArray();->whereNotIn("id",$results)
        $invite = Invite::where('start', '<=', \Illuminate\Support\Carbon::now())->where('end', '>=', Carbon::now())->where(function ($q){$q->where("user_id",Auth::id());$q->orWhere("department_id",Auth::user()->department_id);})->where(["status"=>0,"type_id"=>2])->with(["department","user","type"])->whereNotIn("id",$results)->find($id);
        if($invite){
            $belbin_quiz = BelbinQuiz::find(1);
            return view("employee.belbin.show",compact("invite","belbin_quiz"));
        }
        else{
            abort(404);
        }
    }

    public function pass($id){
        $results = Auth::user()->results()->pluck("invites_id")->toArray();
        $invite = Invite::where('start', '<=', \Illuminate\Support\Carbon::now())->where('end', '>=', Carbon::now())->where(function ($q){$q->where("user_id",Auth::id());$q->orWhere("department_id",Auth::user()->department_id);})->where(["status"=>0,"type_id"=>2])->with(["department","user","type"])->whereNotIn("id",$results)->find($id);
        if($invite){
            return view("employee.belbin.pass",compact("invite"));
        }
        else{
            abort(404);
        }
    }
}
