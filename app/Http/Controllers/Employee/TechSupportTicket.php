<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Admin\TechSupportCategoryTicket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketCreateRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TechSupportTicket extends Controller
{
    public function index(){
        return view("employee.tech-support.index");
    }

    public function create(){
        $categories = TicketCategory::all();
        return view("employee.tech-support.create",compact("categories"));
    }

    public function store(TicketCreateRequest $request){
       try{
           $input = $request->only(["title","description","file_url","category_id"]);
           $input["user_id"] = auth()->id();
           $ticket = Ticket::add($input);
           if($request->hasFile("file_url")){
               $ticket = $ticket->uploadFile($request->file("file_url"),"file_url");
           }
           return redirect()->route("tech-support-ticket-show",$ticket->id);
       }
       catch (\Exception $exception){
           toastError($exception->getMessage());
       }
       return redirect()->route("tech-support-ticket-list");
    }

    public function show($id){
        $ticket = Ticket::where(["user_id" => auth()->id(),"id"=>$id])->first();
        if($ticket){
            return view("employee.tech-support.show",compact("ticket"));
        }
        return redirect()->route("tech-support-ticket-list");
    }
}
