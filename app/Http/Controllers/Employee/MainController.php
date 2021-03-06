<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Employee;
use App\Models\BelbinQuiz;
use App\Models\BelbinUser;
use App\Models\Company;
use App\Models\Department;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('employee.index', compact('user'));
    }

    public function settings()
    {
        $jsValidator = JsValidator::make(
            [
                "name" => "required",
                "img" => "sometimes|image|max:4096",
                "phone" => "required|max:255",
                'password' => 'sometimes|min:4'
            ]
        );
        return view('employee.settings', compact('jsValidator'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, ["name" => "required|max:255", "phone" => "required|max:255", "img" => "sometimes|image|max:4096", "password" => "sometimes|nullable|min:4|max:255"]);
        $user = User::find(Auth::id());
        $request['role_id'] = 2;
        if (User::updateData($request, $user)) {
            toastSuccess('Успешно обновлен!');
            return redirect(route('employeeHome'));
        } else {
            toastError('Что то пошло не так!');
            return redirect()->back();
        }
    }

    public function invite()
    {
        $results = Auth::user()->results()->pluck("invites_id")->toArray();

        $invites = Invite::where('start', '<=', Carbon::now())->where('end', '>=', Carbon::now())->where("department_id",Auth::user()->department_id)->where(function ($q) {
            $q->where("user_id", Auth::id());
            $q->orWhere("user_id",null);
        })->where("status", 0)->with(["department", "user", "type"])->whereNotIn("id", $results)->orderBy("created_at","DESC")->paginate(15);
        return view("employee.invite.index", compact("invites"));
    }

    public function results()
    {
        $results = Result::where("user_id", Auth::id())->with(["invite", "job", "user"])->orderBy("pass_time", "DESC")->paginate(15);
        return view("employee.result.index", compact("results"));
    }

    public function solovievShow($id)
    {
        $result = Result::where(["user_id" => Auth::id()])->with(["job", "user"])->find($id);
        if ($result) {
            $invite = Invite::where(function ($q) {
                $q->where("user_id", Auth::id());
                $q->orWhere("department_id", Auth::user()->department_id);
            })->where("visible",1)->with(["department", "type"])->find($result->invites_id);
            if ($invite) {
                $meaning = UserMeaning::where("result_id", $result->id)->with(["result"])->get();
                $motivation = UserMotivation::where("result_id", $result->id)->get();
                $motives = UserMotive::where("result_id", $result->id)->with("motive")->get();
                $scales = UserScale::where("result_id", $result->id)->with("scale")->get();
                $job_motive = JobMotive::where("job_id", $result->job_id)->get()->groupBy("motive_id")->toArray();
                $all_motives = collect(Motive::get()->groupBy("id")->toArray());
                if ($invite->type_id == 1 && $meaning->isNotEmpty() && $motivation->isNotEmpty() && $motives->isNotEmpty() && $scales->isNotEmpty() && count($job_motive) && count($all_motives)) {
                    return view("employee.result.soloviev-show", compact("result", "meaning", "motivation", "motives", "scales", "job_motive", "invite", "all_motives"));
                }
                abort(404);

            } else {
                abort(404);
            }

        } else {
            abort(404);
        }


    }

    public function belbinShow($id)
    {
        $result = Result::where(["user_id" => Auth::id()])->with(["job", "user"])->find($id);
        if ($result) {
            $invite = Invite::where(function ($q) {
                $q->where("user_id", Auth::id());
                $q->orWhere("department_id", Auth::user()->department_id);
            })->where("visible",1)->with(["department", "type"])->find($result->invites_id);
            if ($invite) {
                $quiz = BelbinQuiz::first();
                $belbin_user = BelbinUser::where("result_id", $result->id)->with("belbinRole")->get();
                if ($belbin_user->isNotEmpty() && $invite->type_id == 2) {
                    return view("employee.result.belbin-show", compact("result", "invite", "belbin_user"));
                } else {
                    abort(404);
                }

            }
            abort(404);
        } else {
            abort(404);
        }

    }

    public function directory()
    {
        $companies = Company::all();
        return view('directory.directory', compact('companies'));
    }

    public function directoryGetUsers(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required|exists:departments,id'
        ]);
        $users = User::where('department_id', $request->get('department_id'))->with('department')->paginate(20);
        return view('directory.show', compact('users'));
    }

    public function news()
    {
        $actual = News::orderBy("created_at", "DESC")->first();
        $news = News::orderBy("created_at", "DESC")->paginate(15);
        return view("employee.news.index", compact("news", 'actual'));
    }

    public function newsOne($id)
    {
        if ($news = News::find($id)) {
            return view("employee.news.show", compact("news"));
        } else {
            abort(404);
        }
    }
}
