<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index()
    {
        if(!auth()->user()->hasPermission("tech-support")){
            abort(404);
        }
        return view("employee.tech-support.management");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!auth()->user()->hasPermission("tech-support")){
            abort(404);
        }
        $ticket = Ticket::where(["id"=>$id])->first();
        if($ticket){
            return view("employee.tech-support.show-management",compact("ticket"));
        }
        return redirect()->route("employee-ticket.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if(!auth()->user()->hasPermission("tech-support")){
            abort(404);
        }
        $ticket = Ticket::where(["id"=>$id])->first();
        if($ticket){
            $ticket->edit(["is_resolved"=>true]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->hasPermission("tech-support")){
            abort(404);
        }
        $ticket = Ticket::where(["id"=>$id])->first();
        if($ticket){
            $ticket->delete();
        }
        return redirect()->route("employee-ticket.index");
    }
}
