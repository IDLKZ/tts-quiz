<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getData(Request  $request){
        if($request->get("type") == "department"){
            $departments = Department::where("company_id",$request->get("company_id"))->get();
            return response()->json($departments->toArray());
        }
        if($request->get("type") == "user"){
            $users = User::where("department_id",$request->get("department_id"))->get();
            return response()->json($users->toArray());
        }
    }
}
