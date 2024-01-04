<?php

namespace App\Http\Livewire\Employee\Forum;

use App\Models\CategoriesForum;
use App\Models\Forum;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $searchInput;
    public $category_ids = [];
    public $categories;

    public function mount(){
        $this->categories = CategoriesForum::withCount("forums")->get();
        $this->category_ids = CategoriesForum::pluck("id")->toArray();
    }

    public function search(){
        $this->search = $this->searchInput;
    }

    public function render()
    {
        return view('livewire.employee.forum.index',[
            "forums" => Forum::whereIn("category_id",$this->category_ids)
                ->withCount([
                    'forum_ratings AS up_vote' => function ($query) {
                        $query->where("rating",">",0);
                    }
                ])
                ->withCount([
                    'forum_ratings AS down_vote' => function ($query) {
                        $query->where("rating","<",0);
                    }
                ])
                ->withCount('forum_messages')->with(["user.department"])
                ->where(function ($query){
                    if ($this->search){
                        $query->where('title','LIKE',"%{$this->search}%")->orWhere("description","LIKE","%{$this->search}%");
                    }
                })
                ->orderBy("created_at","desc")->paginate(20)
        ]);
    }
}
