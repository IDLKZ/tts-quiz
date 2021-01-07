<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BelbinQuiz;
use App\Models\BelbinUser;
use App\Models\Invite;
use App\Models\JobMotive;
use App\Models\Motive;
use App\Models\News;
use App\Models\Result;
use App\Models\User;
use App\Models\UserMeaning;
use App\Models\UserMotivation;
use App\Models\UserMotive;
use App\Models\UserScale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class MainController extends Controller
{
    public function index()
    {
        $news = News::orderBy("created_at","DESC")->first();
        return view('admin.index',compact("news"));
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

    public function updateProfile(Request $request)
    {
        $this->validate($request,["role_id"=>"required|exists:roles,id", "name"=>"required|max:255","phone"=>"required|max:255","img"=>"sometimes|image|max:4096","position"=>"required|max:255","email"=>"required|email|unique:users,email,".$id, "password"=>"sometimes|nullable|min:4|max:255"]);
        $user = User::find(Auth::id());
        if(User::updateData($request,$user)){
            toastSuccess('Успешно обновлен!');
            return redirect(route('adminHome'));
        }
        else{
            toastError('Что то пошло не так!');
            return redirect()->back();
        }
    }


    public function solovievShow($userId, $id)
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

    public function belbinShow($userId, $id)
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
                    return view("employee.result.belbin-show",compact("result","invite","belbin_user"));
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

    public function directory()
    {
        return view('directory.directory');
    }

    public function directoryGetUsers(Request $request)
    {
        $this->validate($request, [
           'department_id' => 'required|exists:departments,id'
        ]);
        $users = User::where('department_id', $request->get('department_id'))->with('department')->paginate(20);
        return view('directory.show', compact('users'));
    }
}
