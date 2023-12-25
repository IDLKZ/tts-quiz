<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCreateRequest;
use App\Http\Requests\Event\EventEditRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.event.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.event.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCreateRequest $request)
    {
        try{
            $input = $request->all();
            $input["start_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["start_date"]);
            if($input["end_date"]){
                $input["end_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["end_date"]);
            }
            $event = Event::add($input);
            $event->uploadFile($request->file("image_url"),"image_url");
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс!");
        }
        return redirect()->route("event.index");
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
        if($event = Event::find($id)){
            return view("admin.event.edit",compact("event"));
        }
        else{
            return redirect()->route("event.index");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventEditRequest $request, $id)
    {
        if($event = Event::find($id)){
            $input = $request->all();
            $input["start_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["start_date"]);
            if($input["end_date"]){
                $input["end_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["end_date"]);
            }
            $event->edit($input);
            if($request->hasFile("image_url")){
                $event->uploadFile($request->file("image_url"),"image_url");
            }
        }
        return redirect()->route("event.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($event = Event::find($id)){
            $event->delete();
        }
        return redirect()->route("event.index");
    }
}
