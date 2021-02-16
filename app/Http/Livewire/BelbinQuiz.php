<?php

namespace App\Http\Livewire;

use App\Mail\PassMail;
use App\Models\BelbinQuestion;
use App\Models\BelbinUser;
use App\Models\Email;
use App\Models\Result;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\BelbinQuiz as Quiz;
use function Symfony\Component\Translation\t;

class BelbinQuiz extends Component
{

    public $belbin_quiz;
    public $belbin_questions;
    public $invite;
    public $test = [];
    public $limitation = [];
    public $activeTab = 1;
    public $rating = 0;
    public $arr;
    public $invite_id;

    protected $rules = [
        'invite_id'=>"required|exists:invites,id",
        'rating' => 'required',
        'arr' => 'required',
        'test'=>'required|size:7',
        'test.*'=>'required|size:8'
    ];


    public function mount(){
        $this->arr = 0;
        $this->invite_id = $this->invite->id;
        $this->belbin_quiz = Quiz::find(1);
        $this->belbin_questions = collect(BelbinQuestion::with("belbinBlog")->get()->groupBy("blog_id"));
    }

    public function collectItem($blog_id,$i,$id){
        if(isset($this->test[$blog_id])){
                $limit=0;
                $tests  = $this->test;
                $tests[$blog_id][$id] = $i;
                foreach($tests[$blog_id] as $k => $rating){
                    $limit += $rating;
                }
                if(!isset($this->test[$blog_id][$id]))
                {
                    if($limit <=10){
                        $this->limitation[$blog_id] = $limit;
                        $this->test[$blog_id][$id] = $i;
                    }
                    else{
                        $this->test[$blog_id][$id] = 0;
                    }
                    $this->arr +=1;
                }
                else{
                    if($limit <=10){
                        $this->limitation[$blog_id] = $limit;
                        $this->test[$blog_id][$id] = $i;
                    }
                }
                $this->rating = 0;
                foreach ($this->limitation as $value){
                    $this->rating += $value;
                }


        }
        else{
            $this->test[$blog_id] = [$id=>$i];
            $this->limitation[$blog_id] = $i;
            $this->arr +=1;
        }
    }

    public function changeActive($id){
        $this->activeTab = $id;
    }

    public function submit(){
        $this->validate();
        if($this->invite->user_id == Auth::id() || $this->invite->department_id == Auth::user()->department_id){
            $tests = $this->test;
            $bq = $this->belbin_questions;
            $belbin_users = [];
            foreach ($tests as $blog_id => $test){
                $index = $bq[$blog_id];
                foreach ($index as $id =>  $value){
                    if(isset($belbin_users[$value["role_id"]])){
                        $belbin_users[$value["role_id"]] += $test[$value["id"]];
                    }
                    else{
                        $belbin_users[$value["role_id"]] = $test[$value["id"]];
                    }
                }
            }
            if($result = Result::makeData(["job_id"=>null,"invite"=>$this->invite_id])){
                if ($this->invite->user_id == Auth::id()){
                    $this->invite->status = 1;
                    $this->invite->save();
                }
                BelbinUser::saveData($belbin_users,$result);
                $emails = Email::pluck("email")->toArray();
                $result = Result::where(["invites_id"=>$this->invite_id,"user_id"=>Auth::id()])->first();
                if($emails && $result){
                    Mail::to($emails)->send(new PassMail($result));
                }
                toastSuccess("Успешно сдано","Выполнено");
            }
            else{
                toastError("Упс что-то пошло не так","Упс");
            }
        }
        else{
            toastError("Упс что-то пошло не так","Упс");
        }
        return redirect(route('employeeHome'));






    }




    public function render()
    {
        $this->belbin_questions = collect(BelbinQuestion::with("belbinBlog")->get()->groupBy("blog_id"));
        return view('livewire.belbin-quiz');
    }
}
