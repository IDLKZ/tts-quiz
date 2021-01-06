<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\File;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return  view("admin.company.index",compact("companies"));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.company.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["title"=>"required|max:255","logo"=>"sometimes|image|max:4096"]);
        if(Company::saveData($request)){
            toastSuccess('Успешно создана!');
            return redirect(route('company.index'));
        }
        else{
            toastError('Упс...! Что то пошло не так!');
            return redirect()->back();
        }
        return  redirect(route("company.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if($company){
            return  view("admin.company.show",compact("company"));
        }
        else{
            return  redirect(route("company.index"));
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
        $company = Company::find($id);
        if($company){
            return  view("admin.company.edit",compact("company"));
        }
        else{
            return  redirect(route("company.index"));
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
        $company = Company::find($id);
        if($company){
            $this->validate($request,["title"=>"required|max:255","logo"=>"sometimes|image|max:4096"]);
            if(Company::updateData($request,$company)){
                toastSuccess('Успешно обновлена!');
                return redirect(route('company.index'));
            }
            else{
                toastError('Упс...! Что то пошло не так!');
                return redirect()->back();
            }
            return  redirect(route("company.index"));
        }
        else{
            return  redirect(route("company.index"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company){
           File::deleteFile($company->logo);
           $company->delete();
            toastInfo('Успешно удалена!');
            return redirect()->back();
        }
        else{
            toastError('Упс...! Что то пошло не так!');
            return redirect()->back();
        }
        return  redirect(route("company.index"));

    }
}
