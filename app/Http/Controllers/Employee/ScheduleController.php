<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        return view("employee.schedule.index");
    }

    public function show($id){
        try{
            $schedule = Schedule::where(["user_id" => auth()->id()])->with(["user"])->find($id);
            if($schedule){
                return view("employee.schedule.show",compact("schedule"));
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return abort(404);
    }
}
