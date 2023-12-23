<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Models\Course;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view("admin.tasks.index",compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.tasks.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {
        try{
            $input = $request->all();
            $input["start_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["start_date"]);
            if($input["end_date"]){
                $input["end_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["end_date"]);
            }
            $input["users"] = array_map('intval', $input["users"]);
            $task = Task::add($input);
        }
        catch (\Exception $exception){

        }
        return redirect()->route("task.index");
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
            $task = Task::find($id);
            if($task){
                return view("admin.tasks.edit",compact("task"));
            }
        }
        catch (\Exception $exception){

        }
        return redirect()->route("task.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskCreateRequest $request, $id)
    {
        try{
            $task = Task::find($id);
            if($task){
                $input = $request->all();
                $input["start_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["start_date"]);
                if($input["end_date"]){
                    $input["end_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["end_date"]);
                }
                $input["users"] = array_map('intval', $input["users"]);
                $task->edit($input);
            }
        }
        catch (\Exception $exception){

        }
        return redirect()->route("task.index");
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
            $task = Task::find($id);
            if($task){
               $task->delete();
            }
        }
        catch (\Exception $exception){

        }
        return redirect()->route("task.index");
    }
}
