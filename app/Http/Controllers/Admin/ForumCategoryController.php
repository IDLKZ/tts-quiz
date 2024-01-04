<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForumCategory\ForumCategoryCreateRequest;
use App\Http\Requests\ForumCategory\ForumCategoryEditRequest;
use App\Models\CategoriesForum;

class ForumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoriesForum::withCount("forums")->orderBy("created_at","DESC")->paginate(30);
        return view("admin.forum-category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.forum-category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumCategoryCreateRequest $request)
    {
        try{
           $category = CategoriesForum::add($request->all());
           $category->uploadFile($request->file("image_url"),"image_url");
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("forum-category.index");
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
            $category = CategoriesForum::find($id);
            if($category){
                return view("admin.forum-category.edit",compact("category"));
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("forum-category.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumCategoryEditRequest $request, $id)
    {
        try{
            $category = CategoriesForum::find($id);
            if($category){
                $category->edit($request->all());
                if($request->hasFile("image_url")){
                    $category->uploadFile($request->file("image_url"),"image_url");
                }
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("forum-category.index");
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
            $category = CategoriesForum::find($id);
            if($category){
                $category->delete();
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("forum-category.index");
    }
}
