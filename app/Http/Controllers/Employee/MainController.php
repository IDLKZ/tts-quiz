<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\JobMotive;
use App\Models\Motive;
use App\Models\Result;
use App\Models\UserMeaning;
use App\Models\UserMotivation;
use App\Models\UserMotive;
use App\Models\UserScale;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }

    public function invite(){
       $results = Auth::user()->results()->pluck("invites_id")->toArray();
        $invites = Invite::where('start', '<=', Carbon::now())->where('end', '>=', Carbon::now())->where(function ($q){$q->where("user_id",Auth::id());$q->orWhere("department_id",Auth::user()->department_id);})->where("status",0)->with(["department","user","type"])->whereNotIn("id",$results)->paginate(15);
        return view("employee.invite.index",compact("invites"));
    }

    public function results(){
        $results = Result::where("user_id",Auth::id())->with(["invite","job","user"])->orderBy("pass_time","DESC")->paginate(15);
        return view("employee.result.index",compact("results"));
    }

    public function solovievShow($id){
        $result = Result::where(["user_id"=>Auth::id()])->with(["job","user"])->find($id);
        if($result){
            $invite = Invite::where("user_id",Auth::id())->orWhere("department_id",Auth::user()->department_id)->with(["department","type"])->find($result->invites_id);
            if($invite){
                $meaning = UserMeaning::where("result_id",$result->id)->with(["result"])->get();
                $motivation = UserMotivation::where("result_id",$result->id)->get();
                $motives = UserMotive::where("result_id",$result->id)->with("motive")->get();
                $scales = UserScale::where("result_id",$result->id)->with("scale")->get();
                $job_motive = JobMotive::where("job_id",$result->job_id)->get()->groupBy("motive_id")->toArray();
                $all_motives = collect(Motive::get()->groupBy("id")->toArray());
                return view("employee.result.soloviev-show",compact("result","meaning","motivation","motives","scales","job_motive","invite","all_motives"));

            }
            else{
                abort(404);
            }

        }
        else{
            abort(404);
        }


    }

    public function belbinShow($id){

    }
}
