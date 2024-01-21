<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\Request;

class EmployeeIdeaController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasPermission("idea-management")){
            abort(404);
        }
        return view("employee.idea.management");
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
        if(!auth()->user()->hasPermission("idea-management")){
            abort(404);
        }
        $idea = Idea::with("user")
            ->withCount([
                'idea_ratings AS up_vote' => function ($query) {
                    $query->where("rating",">",0);
                }
            ])
            ->withCount([
                'idea_ratings AS down_vote' => function ($query) {
                    $query->where("rating","<",0);
                }
            ])
            ->withSum("idea_ratings","rating")
            ->find($id);
        if($idea){
            return view("employee.idea.management-show",compact("idea"));
        }
        return  redirect()->back();
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
        if(!auth()->user()->hasPermission("idea-management")){
            abort(404);
        }
        $this->validate($request,["status"=>"required|integer|min:-1|max:2"]);
        $idea = Idea::find($id);
        if($idea){
            $idea->edit($request->only(["status","opinion"]));
        }
        return  redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
