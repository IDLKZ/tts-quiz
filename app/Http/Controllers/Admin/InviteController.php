<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteMail;
use App\Models\Company;
use App\Models\Department;
use App\Models\Invite;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invites = Invite::with(["type","department","user","results"])->paginate(15);
        return  view("admin.invite.index",compact("invites"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jsValidator = JsValidator::make(
            ["title"=>"required|max:255",
                "department_id"=>"required|exists:departments,id",
                "simple_quiz"=>"required_if:invite_type,==,3",
                "type_id"=>"required|exists:types,id",
                "start"=>"required","end"=>"required",
            ]
        );
        $types = Type::all();
        return view("admin.invite.create", compact('types'));
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
        ["title"=>"required|max:255", "department_id"=>"required|exists:departments,id",
            "simple_quiz"=>"required_if:invite_type,==,3",
            "type_id"=>"required|exists:types,id","start"=>"required","end"=>"required",
        ]);
        if($id = Invite::saveData($request)){
            $user = User::find($request->user_id);
            $detail = [
                "id"=>$id,
              "info"=>$request->all(),
              "user"=>$user
            ];
             session()->put("name","man");
            if($user){
                Mail::to($user->email)->send(new InviteMail($detail));
            }
            toastSuccess("Успешно создано приглашение","Выполнено");
            return redirect(route('invite.index'));
        }
        else{
            toastWarning("Что-то пошло не так","Упс");
            return redirect()->back();
        }
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
        $jsValidator = JsValidator::make(
            ["title"=>"required|max:255",
                "department_id"=>"required|exists:departments,id",
                "simple_quiz"=>"required_if:invite_type,==,3",
                "type_id"=>"required|exists:types,id",
                "start"=>"required","end"=>"required",
            ]
        );
        $types = Type::all();
        if($invite){
            return view("admin.invite.edit",compact("invite", 'jsValidator', 'types'));
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
                toastSuccess("Успешно обновлено","Выполнено");
                return redirect(route('invite.index'));
            }
            else{
                toastWarning("Что-то пошло не так","Упс");
                return redirect()->back();
            }
        }
        return ;
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
            toastSuccess("Успешно удалено!","Выполнено");
        }
        else{
            toastWarning("Приглашение не найдено","Упс");
        }
        return redirect(route("invite.index"));

    }
}
