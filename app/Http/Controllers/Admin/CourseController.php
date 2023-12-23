<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Course\CourseEditRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Psy\Util\Str;
use function Sodium\add;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::withCount(["lessons"])->orderBy("created_at","asc")->paginate(20);
        return view("admin.course.index",compact("courses"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.course.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseCreateRequest $request)
    {
        try{
            $input = $request->all();
            $input["alias"] = \Illuminate\Support\Str::random(32);
            $course = Course::add($input);
            $course->uploadFile($request->file("image_url"),"image_url");
        }
        catch (\Exception $exception){

        }
        return redirect()->route("course.index");
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
        if($course = Course::find($id)){
            return view("admin.course.edit",compact("course"));
        }
        else{
           return redirect()->route("course.index");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseEditRequest $request, $id)
    {
        if($course = Course::find($id)){
            $input = $request->all();
            $course->edit($input);
            if($request->file("image_url")){
                $course->uploadFile($request->file("image_url"),"image_url");
            }
        }
        return redirect()->route("course.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($course = Course::find($id)){
            $course->delete();
        }
        return redirect()->route("course.index");
    }
}