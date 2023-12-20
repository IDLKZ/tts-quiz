<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionCreateRequest;
use App\Http\Requests\Question\QuestionEditRequest;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with(["lesson.course"])->orderBy("created_at","asc")->paginate(50);
        return view("admin.question.index",compact("questions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.question.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request)
    {
        try{
            $input = $request->all();
            Question::add($input);
        }
        catch (\Exception $exception){

        }
        return redirect()->route("question.index");
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
        if($question = Question::find($id)){
            return view("admin.question.edit",compact("question"));
        }
        else{
            return redirect()->route("question.index");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionEditRequest $request, $id)
    {
        if($question = Question::find($id)){
            $input = $request->all();
            $question->edit($input);
        }
        return redirect()->route("question.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($question = Question::find($id)){
            $question->delete();
        }
        return redirect()->route("question.index");
    }
}
