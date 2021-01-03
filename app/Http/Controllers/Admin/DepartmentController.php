<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\File;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::with("company")->paginate(15);
        return view("admin.department.index",compact("departments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::pluck("title","id")->toArray();
        return view("admin.department.create",compact("companies"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["company_id"=>"required|exists:companies,id","title"=>"required","logo"=>"sometimes|image|max:4096"]);
        if(Department::saveData($request)){

        }
        else{

        }
        return redirect(route("department.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::with("company")->find($id);
        if($department){
            return  view("admin.department.show",compact("department"));
        }
        else{
            return redirect(route("department.index"));
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
        $companies = Company::pluck("title","id")->toArray();
        $department = Department::with("company")->find($id);
        if($department){
            return  view("admin.department.edit",compact("department","companies"));
        }
        else{
            return redirect(route("department.index"));
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
        $department = Department::find($id);
        if($department){
            $this->validate($request,["company_id"=>"required|exists:companies,id","title"=>"required","logo"=>"sometimes|image|max:4096"]);
            if(Department::updateData($request,$department)){

            }
            else{

            }
        }

        return redirect(route("department.index"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if($department){
            File::deleteFile($department->logo);
            $department->delete();
        }
        return redirect(route("department.index"));

    }
}
