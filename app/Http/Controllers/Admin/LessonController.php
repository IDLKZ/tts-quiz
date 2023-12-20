<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\LessonCreateRequest;
use App\Http\Requests\Lesson\LessonEditRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::with(["course"])->orderBy("created_at","asc")->paginate(20);
        return view("admin.lesson.index",compact("lessons"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.lesson.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonCreateRequest $request)
    {
        try{
            $input = $request->all();
            $input["alias"] = \Illuminate\Support\Str::random(32);
            $lesson = Lesson::add($input);
            $lesson->uploadFile($request->file("image_url"),"image_url");
            if($request->hasFile("video_url")){
                $lesson->edit(["video_type"=>$request->file("video_url")->getMimeType()]);
                $lesson->uploadFile($request->file("video_url"),"video_url");
            }
        }
        catch (\Exception $exception){
                dd($exception);
        }
        return redirect()->route("lesson.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($lesson = Lesson::find($id)){
            return view("admin.lesson.edit",compact("lesson"));
        }
        else{
            return redirect()->route("lesson.index");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonEditRequest $request, $id)
    {
        if($lesson = Lesson::find($id)){
            $input = $request->all();
            $lesson->edit($input);
            if($request->hasFile("video_url")){
                $lesson->edit(["video_type"=>$request->file("video_url")->getMimeType()]);
                $lesson->uploadFile($request->file("video_url"),"video_url");
            }
            if($request->file("image_url")){
                $lesson->uploadFile($request->file("image_url"),"image_url");
            }
        }
        return redirect()->route("lesson.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($lesson = Lesson::find($id)){
            $lesson->delete();
        }
        return redirect()->route("lesson.index");
    }
}
