<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy("created_at","DESC")->paginate(15);
        return view("admin.news.index",compact("news"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jsValidator = JsValidator::make(
            ["img" => "required", "title" => "required", "subtitle" => "required", "description" => "required"]
        );
        return view("admin.news.create",compact("jsValidator"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["img" => "required", "title" => "required", "subtitle" => "required", "description" => "required"]);
        if(News::saveData($request)){
            toastSuccess("Успешно создана новость","Выполнено");
        }
        else{
            toastWarning("Что-то пошло не так","Упс");
        }
        return  redirect(route("news.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($news = News::find($id)){
            return view("admin.news.show",compact("news"));
        }
        else{
            abort(404);
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
        if($news = News::find($id)){
            $jsValidator = JsValidator::make(
                ["img"=>"required","title"=>"required","subtitle"=>"required","description"=>"required"]
            );
            return view("admin.news.edit",compact("news","jsValidator"));
        }
        else{
            abort(404);
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
        if($news = News::find($id)){
            $this->validate($request,["img"=>"required","title"=>"required","subtitle"=>"required","description"=>"required"]);
            if(News::updateData($request,$news)){
                toastSuccess("Успешно обновлена новость","Выполнено");
            }
            else{
                toastWarning("Что-то пошло не так","Упс");
            }
            return  redirect(route("news.index"));
        }
        else{
            abort(404);
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
        if($news = News::find($id)){
            $news->delete();
            toastSuccess("Успешно удалена новсть","Выполнено");
        }
        return redirect(route("news.index"));

    }
}
