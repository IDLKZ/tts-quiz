<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LiteratureCategory\LiteratureCategoryCreateRequest;
use App\Http\Requests\LiteratureCategory\LiteratureCategoryEditRequest;
use App\Models\Literature;
use App\Models\LiteratureCategory;
use Illuminate\Http\Request;

class LiteratureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = LiteratureCategory::withCount("literatures")->orderBy("created_at","DESC")->paginate(30);
        return view("admin.literature-category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.literature-category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LiteratureCategoryCreateRequest $request)
    {
        try{
            LiteratureCategory::add($request->all());
        }
        catch (\Exception $exception){
        }
        return redirect()->route("literature-category.index");
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
        try{
            $category = LiteratureCategory::find($id);
            if($category){
                return view("admin.literature-category.edit",compact("category"));
            }
        }
        catch (\Exception $exception){
        }
        return redirect()->route("literature-category.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LiteratureCategoryEditRequest $request, $id)
    {
        try{
            $category = LiteratureCategory::find($id);
            if($category){
                $category->edit($request->all());
            }
        }
        catch (\Exception $exception){
        }
        return redirect()->route("literature-category.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $category = LiteratureCategory::find($id);
            if($category){
                $category->delete();
            }
        }
        catch (\Exception $exception){
        }
        return redirect()->route("literature-category.index");
    }
}
