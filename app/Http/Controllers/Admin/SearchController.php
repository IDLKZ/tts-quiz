<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(){
        return view("admin.search.search");
    }

    public function result(Request $request){
        $this->validate($request,["search"=>"required"]);
        $search = $request->get("search");
        $users = User::where("name","like","%". $search."%")->paginate(12);
        return view("admin.search.result",compact("search","users"));



    }
}
