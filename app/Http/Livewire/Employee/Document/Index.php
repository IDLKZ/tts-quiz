<?php

namespace App\Http\Livewire\Employee\Document;

use App\Models\Document;
use App\Models\DocumentCategory;
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
        $this->categories = DocumentCategory::all();
    }



    public function render()
    {
        return view('livewire.employee.document.index',
            [
                'documents' => Document::where(function ($query) {
                    if($this->category_ids){
                        $query->where('title','like',"%{$this->search}%")->whereIn("id",$this->category_ids);
                    }
                    else{
                        $query->where('title','like',"%{$this->search}%");
                    }
                })->with(["document_category"])->paginate(10),
            ]
        );
    }
}
