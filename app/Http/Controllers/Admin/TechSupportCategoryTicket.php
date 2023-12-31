<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechSupportCategory\TechSupportCategoryCreateRequest;
use App\Http\Requests\TechSupportCategory\TechSupportCategoryEditRequest;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TechSupportCategoryTicket extends Controller
{
    public function index()
    {
        $categories = TicketCategory::withCount("tickets")->orderBy("created_at","DESC")->paginate(30);
        return view("admin.tech-support-category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.tech-support-category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechSupportCategoryCreateRequest $request)
    {
        try{
            TicketCategory::add($request->all());
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("ticket-category.index");
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
            $category = TicketCategory::find($id);
            if($category){
                return view("admin.tech-support-category.edit",compact("category"));
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("ticket-category.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TechSupportCategoryEditRequest $request, $id)
    {
        try{
            $category = TicketCategory::find($id);
            if($category){
                $category->edit($request->all());
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("ticket-category.index");
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
            $category = TicketCategory::find($id);
            if($category){
                $category->delete();
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("ticket-category.index");
    }
}
