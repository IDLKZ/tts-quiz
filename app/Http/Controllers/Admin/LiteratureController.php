<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Literature\DocumentCreateRequest;
use App\Http\Requests\Literature\DocumentEditRequest;
use App\Http\Requests\Literature\LiteratureCreateRequest;
use App\Http\Requests\Literature\LiteratureEditRequest;
use App\Models\Literature;
use App\Models\LiteratureCategory;
use Illuminate\Http\Request;

class LiteratureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $literatures = Literature::orderBy("created_at","desc")->paginate(24);
        return view("admin.literature.index",compact("literatures"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.literature.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LiteratureCreateRequest $request)
    {
        try{

           $literature = Literature::add($request->all());
            if($request->hasFile("image_url")){
                $literature->uploadFile($request->file("image_url"),"image_url");
            }
            if($request->hasFile("file_url")){
                $literature->uploadFile($request->file("file_url"),"file_url");
                $literature->edit(["file_type"=>$request->file("file_url")->getMimeType()]);
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("literature.index");
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
            $literature = Literature::find($id);
            if($literature){
                return view("admin.literature.edit",compact("literature"));
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("literature.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LiteratureEditRequest $request, $id)
    {
        try{
            $literature = Literature::find($id);
            if($literature){
                $input = $request->all();
                $literature->edit($input);
                if($request->hasFile("image_url")){
                    $literature->uploadFile($request->file("image_url"),"image_url");
                }
                if($request->hasFile("file_url")){
                    $literature->uploadFile($request->file("file_url"),"file_url");
                    $literature->edit(["file_type"=>$request->file("file_url")->getMimeType()]);
                }
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("literature.index");
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
            $literature = Literature::find($id);
            if($literature){
                $literature->delete();
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("literature.index");
    }
}
