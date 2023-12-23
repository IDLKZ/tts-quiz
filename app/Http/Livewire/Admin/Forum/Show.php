<?php

namespace App\Http\Livewire\Admin\Forum;

use App\Models\Forum;
use App\Models\ForumMessage;
use App\Models\ForumMessageRating;
use App\Models\ForumRating;
use Livewire\Component;

class Show extends Component
{
    public $comment;
    public $respond;
    public $comments;
    public $user;
    public $forum;
    public $forum_id;
    public $message_id;
    public $message;
    public $forumRating;

    public function mount(Forum $forum){
        $this->forum = $forum;
        $this->forum_id = $forum->id;
        $this->forumRating = ForumRating::where(["forum_id" => $this->forum_id])->sum("rating");
        $this->comments = ForumMessage::where(["forum_id" => $this->forum->id,"message_id" => null])
            ->with(["forum_message_ratings","forum_messages.forum_message_ratings","forum_messages.user","user"])
            ->withSum("forum_message_ratings","rating")
            ->orderBy("created_at","asc")->get();
        $this->user = auth()->user();
    }

    public function rateForumUp(){
        $forum_rating = ForumRating::where(["forum_id" => $this->forum_id,"user_id" => $this->user->id])->first();
        if($forum_rating){
            $forum_rating->edit(["rating"=>1]);
        }
        else{
            ForumRating::add(["forum_id" => $this->forum_id,"user_id" => $this->user->id,"rating"=>1]);
        }
        $this->forumRating = ForumRating::where(["forum_id" => $this->forum_id])->sum("rating");
    }
    public function rateForumDown(){
        $forum_rating = ForumMessageRating::where(["forum_id" => $this->forum_id,"user_id" => $this->user->id])->first();
        if($forum_rating){
            $forum_rating->edit(["rating"=>-1]);
        }
        else{
            ForumMessageRating::add(["forum_id" => $this->forum_id,"user_id" => $this->user->id,"rating"=>-1]);
        }

    }
    public function rateMessageUp($message_id){
        $forum_rating = ForumMessageRating::where(["message_id" => $message_id,"user_id" => $this->user->id])->first();
        if($forum_rating){
            $forum_rating->edit(["rating"=>1]);
        }
        else{
            ForumMessageRating::add(["message_id" => $message_id,"user_id" => $this->user->id,"rating"=>1]);
        }
        $this->comments = ForumMessage::where(["forum_id" => $this->forum->id,"message_id" => null])
            ->with(["forum_message_ratings","forum_messages.forum_message_ratings","forum_messages.user","user"])
            ->withSum("forum_message_ratings","rating")
            ->orderBy("created_at","asc")->get();
    }
    public function rateMessageDown($message_id){
        $forum_rating = ForumMessageRating::where(["message_id" => $message_id,"user_id" => $this->user->id])->first();
        if($forum_rating){
            $forum_rating->edit(["rating"=>-1]);
        }
        else{
            ForumMessageRating::add(["message_id" => $message_id,"user_id" => $this->user->id,"rating"=>-1]);
        }
        $this->comments = ForumMessage::where(["forum_id" => $this->forum->id,"message_id" => null])
            ->with(["forum_message_ratings","forum_messages.forum_message_ratings","forum_messages.user","user"])
            ->withSum("forum_message_ratings","rating")
            ->orderBy("created_at","asc")->get();
    }

    public function setMessage($forumMessage){
        $this->respond = $forumMessage;
    }

    public function resetMessage(){
        $this->respond = null;
    }

    public function createComment(){
        if($this->message && $this->forum){
            ForumMessage::add(["message"=>$this->message,"forum_id"=>$this->forum->id,"user_id"=>$this->user->id,"message_id"=>$this->respond? $this->respond["id"] : null]);
            $this->comments = ForumMessage::where(["forum_id" => $this->forum->id,"message_id" => null])
                ->with(["forum_message_ratings","forum_messages.forum_message_ratings","forum_messages.user","user"])
                ->withSum("forum_message_ratings","rating")
                ->orderBy("created_at","asc")->get();
            $this->emit('emptyCKEditor');
        }
    }

    public function render()
    {
        $this->comments = ForumMessage::where(["forum_id" => $this->forum->id,"message_id" => null])
            ->with(["forum_message_ratings","forum_messages.forum_message_ratings","forum_messages.user","user"])
            ->withSum("forum_message_ratings","rating")
            ->orderBy("created_at","asc")->get();
        return view('livewire.admin.forum.show');
    }
}
