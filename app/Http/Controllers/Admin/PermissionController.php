<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view("admin.permission.index",compact("permissions"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.permission.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["name"=>"required|max:255|unique:permissions,name"]);
        Permission::create(["name" => $request->get("name"),"guard_name" => "web"]);
        return redirect()->route("permission.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::where(["id"=>$id])->first();
        if(!$permission){
            toastr()->warning("Не найдено");
            return redirect()->route("permission.index");
        }
        return view("admin.permission.edit",compact("permission"));
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
        $this->validate($request,["name"=>"required|max:255|unique:permissions,name,".$id]);
        $permission = Permission::where(["id"=>$id])->first();
        if(!$permission){
            toastr()->warning("Не найдено");
            return redirect()->route("permission.index");
        }
        $permission->update(["name"=>$request->get("name")]);
        toastr()->success("Успешно изменено");
        return redirect()->route("permission.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::where(["id"=>$id])->first();
        if(!$permission){
            toastr()->warning("Не найдено");
            return redirect()->route("permission.index");
        }
        $permission->delete();
        toastr()->success("Успешно удалено");
        return redirect()->route("permission.index");
    }
}
