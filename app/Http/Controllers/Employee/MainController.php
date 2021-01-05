<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Invite;
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
}
