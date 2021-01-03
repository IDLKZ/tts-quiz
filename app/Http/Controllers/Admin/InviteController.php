<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Invite;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invites = Invite::with(["type","department","user","results","company"])->paginate(15);
        return  view("admin.invite.index",compact("invites"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = Company::all();
        $types = Type::all();
        return view("admin.invite.create",compact("types","companies"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        ["title"=>"required|max:255", "department_id"=>"required_if:invite_type,==,1",
            "user_id"=>"required_if:invite_type,==,2","simple_quiz"=>"required_if:invite_type,==,3",
            "type_id"=>"required|exists:types,id","start"=>"required","end"=>"required"
        ]);
        if(Invite::saveData($request)){

        }
        else{

        }
        return  redirect(route("invite.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invite = Invite::with(["department","user","type","results"])->find($id);
        if($invite){
            return view("admin.invite.show",compact("invite"));
        }
        else{
            return redirect(route("invite.index"));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invite = Invite::with(["department","user","type","results"])->find($id);
        if($invite){
            return view("admin.invite.edit",compact("invite"));
        }
        else{
            return redirect(route("invite.index"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invite = Invite::find($id);
        if($invite){
            $this->validate($request,
                ["title"=>"required|max:255", "department_id"=>"required_if:invite_type,==,1",
                    "user_id"=>"required_if:invite_type,==,2","simple_quiz"=>"required_if:invite_type,==,3",
                    "type_id"=>"required|exists:types,id","start"=>"required","end"=>"required"
                ]);
            if(Invite::updateData($request,$invite)){

            }
            else{

            }
        }
        else{

        }
        return  redirect(route("invite.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invite = Invite::find($id);
        if($invite){
            $invite->delete();
        }
        else{

        }
        return redirect(route("invite.index"));

    }
}
