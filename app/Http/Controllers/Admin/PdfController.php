<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BelbinQuiz;
use App\Models\BelbinUser;
use App\Models\Invite;
use App\Models\JobMotive;
use App\Models\Motive;
use App\Models\Result;
use App\Models\User;
use App\Models\UserMeaning;
use App\Models\UserMotivation;
use App\Models\UserMotive;
use App\Models\UserScale;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function solovievShowPdf($userId, $id)
        {
            $result = Result::where(["user_id" => $userId])->with(["job","user"])->find($id);
            $auth = User::find($userId);
            if($result){
                $invite = Invite::where("user_id", $userId)->orWhere("department_id", $auth->department_id)->with(["department","type"])->find($result->invites_id);
                if($invite){
                    $meaning = UserMeaning::where("result_id",$result->id)->with(["result"])->get();
                    $motivation = UserMotivation::where("result_id",$result->id)->get();
                    $motives = UserMotive::where("result_id",$result->id)->with("motive")->get();
                    $scales = UserScale::where("result_id",$result->id)->with("scale")->get();
                    $job_motive = JobMotive::where("job_id",$result->job_id)->get()->groupBy("motive_id")->toArray();
                    $all_motives = collect(Motive::get()->groupBy("id")->toArray());
                    return view("pdf.soloview",compact("result","meaning","motivation","motives","scales","job_motive","invite","all_motives"));

                }
                else{
                    abort(404);
                }

            }
            else{
                abort(404);
            }
        }

    public function belbinShowPdf($userId, $id)
    {
        $result = Result::where(["user_id" => $userId])->with(["job","user"])->find($id);
        $user = User::find($userId);
        if($result){
            $invite = Invite::where(function ($q) use ($user){
                $q->where("user_id", $user->id);$q->orWhere("department_id",$user->department_id);
            })->with(["department","type"])->find($result->invites_id);
            if($invite){
                $quiz = BelbinQuiz::first();
                $belbin_user = BelbinUser::where("result_id",$result->id)->with("belbinRole")->get();
                if($belbin_user->isNotEmpty() && $invite->type_id == 2){
                    return view("pdf.belbin",compact("result","invite","belbin_user"));
                }
                else{
                    abort(404);
                }

            }
            abort(404);
        }
        else{
            abort(404);
        }
    }


}
