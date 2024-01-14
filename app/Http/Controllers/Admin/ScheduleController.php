<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\ScheduleCreateRequest;
use App\Http\Requests\Schedule\ScheduleEditRequest;
use App\Models\Event;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.schedule.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.schedule.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleCreateRequest $request)
    {
        try{
            $input = $request->all();
            $input["start_at"] = Carbon::createFromFormat('d/m/Y H:i',$request["start_at"]);
            $input["end_at"] = Carbon::createFromFormat('d/m/Y H:i',$request["end_at"]);
            $schedule = Schedule::add($input);
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("admin-schedule.index");
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
            $schedule = Schedule::with(["user"])->find($id);
            if($schedule){
                return view("admin.schedule.edit",compact("schedule"));
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("admin-schedule.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleEditRequest $request, $id)
    {
        try{
            $schedule = Schedule::with(["user"])->find($id);
            if($schedule){
                $input = $request->all();
                $input["start_at"] = Carbon::createFromFormat('d/m/Y H:i',$request["start_at"]);
                $input["end_at"] = Carbon::createFromFormat('d/m/Y H:i',$request["end_at"]);
                $schedule->edit($input);
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("admin-schedule.index");
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
            $schedule = Schedule::with(["user"])->find($id);
            if($schedule){
               $schedule->delete();
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("admin-schedule.index");
    }
}
