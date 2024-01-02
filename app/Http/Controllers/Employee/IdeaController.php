<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeIdea\EmployeeIdeaCreateRequest;
use App\Models\Idea;
use App\Models\IdeaRating;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::with(["user"])
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
            ->withSum("idea_ratings","rating")->orderBy("created_at","desc")->paginate(20);
        return view("employee.idea.index",compact("ideas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("employee.idea.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeIdeaCreateRequest $request)
    {
        try{
            $input = $request->only(["title","description","keywords"]);
            $input["user_id"] = auth()->id();
            $idea = Idea::add($input);
            if($request->file("image_url")){
                $idea->uploadFile($request->file("image_url"),"image_url");
            }
            if($request->file("file_url")){
                $idea->uploadFile($request->file("file_url"),"file_url");
            }
            toastSuccess("Успешно добавлена идея!");
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс");
        }
        return redirect()->route("employee-idea.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
            return view("employee.idea.show",compact("idea"));
        }
        return  redirect()->back();
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
        try{
            $rating_user = $request->get("rating_user") ?? 0;
            if($rating_user >= 1){
                $rating_user = 1;
            }
            if($rating_user < 0){
                $rating_user = -1;
            }
            $rating = IdeaRating::where(["idea_id" => $id,"user_id" => auth()->id()])->first();
            if($rating){
                if($rating->rating == $rating_user){
                    $rating->delete();
                    toastSuccess("Успешно убрана оценка!");
                }
                else{
                    $rating->edit(["rating"=>$rating_user]);
                    toastSuccess("Успешно поставлена оценка!");

                }
            }
            else{
                IdeaRating::add(["idea_id" => $id,"user_id" => auth()->id(),"rating"=>$rating_user]);
                toastSuccess("Успешно поставлена оценка!");
            }
        }
        catch (\Exception $exception){
            toastError($exception->getMessage(),"Упс");
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
        $idea = Idea::where(["user_id" => auth()->id()])->find($id);
        if($idea){
            $idea->delete();
        }
        return redirect()->route("employee-idea.index");
    }
}
