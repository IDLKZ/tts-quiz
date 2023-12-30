<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentCreateRequest;
use App\Http\Requests\Document\DocumentEditRequest;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::orderBy("created_at","desc")->paginate(24);
        return view("admin.document.index",compact("documents"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.document.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentCreateRequest $request)
    {
        try{

            $document = Document::add($request->all());
            if($request->hasFile("image_url")){
                $document->uploadFile($request->file("image_url"),"image_url");
            }
            if($request->hasFile("file_url")){
                $document->uploadFile($request->file("file_url"),"file_url");
                $document->edit(["file_type"=>$request->file("file_url")->getType()]);
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("document.index");
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
            $document = Document::find($id);
            if($document){
                return view("admin.document.edit",compact("document"));
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("document.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentEditRequest $request, $id)
    {
        try{
            $document = Document::find($id);
            if($document){
                $input = $request->all();
                $document->edit($input);
                if($request->hasFile("image_url")){
                    $document->uploadFile($request->file("image_url"),"image_url");
                }
                if($request->hasFile("file_url")){
                    $document->uploadFile($request->file("file_url"),"file_url");
                    $document->edit(["file_type"=>$request->file("file_url")->getType()]);
                }
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("document.index");
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
            $document = Document::find($id);
            if($document){
                $document->delete();
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("document.index");
    }
}
