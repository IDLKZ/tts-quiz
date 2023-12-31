<?php

namespace App\Http\Livewire\Employee\Literature;

use App\Models\Literature;
use App\Models\LiteratureCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;

    public $categories;
    public $category_ids = [];



    public function mount(){
        $this->categories = LiteratureCategory::all();
    }



    public function render()
    {
        return view('livewire.employee.literature.index',
            [
                'literatures' => Literature::where(function ($query) {
                    if($this->category_ids){
                        $query->where('title','like',"%{$this->search}%")->whereIn("id",$this->category_ids);
                    }
                    else{
                        $query->where('title','like',"%{$this->search}%");
                    }
                })->with(["literature_category"])->paginate(10),
            ]
        );
    }
}
