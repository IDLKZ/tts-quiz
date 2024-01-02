<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\PassedLesson;
use App\Models\PassedQuestion;
use App\Models\Question;
use App\Models\UsersAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function passQuiz($id){
        $lesson = Lesson::with("course")->find($id);
        $questions = Question::where(["lesson_id" => $id])->get();
        if($questions && $lesson){
            return view("employee.quiz.index",compact("questions","lesson"));
        }
        return abort(404);
    }


    public function passExam(Request $request){
        $input = $request->all();
        $user = auth()->user();
        if($lesson = Lesson::with("questions")->find($input["lesson_id"])){
            $attempt = UsersAttempt::add(["user_id"=>$user->id,"lesson_id"=>$input["lesson_id"]]);
            $point = 0;
            foreach ($lesson->questions as $question){
                if(array_key_exists($question->id,$input["answers"])){
                    if(strtolower($input["answers"][$question->id]) == $question->correct_answer){
                        PassedQuestion::add(["attempt_id"=>$attempt->id,"question_id"=>$question->id,"is_right"=>true,"is_answered"=>true,"given_answer"=>strtolower($input["answers"][$question->id])]);
                        $point++;
                    }
                    else{
                        PassedQuestion::add(["attempt_id"=>$attempt->id,"question_id"=>$question->id,"is_right"=>false,"is_answered"=>true]);
                    }
                }
                else{
                    PassedQuestion::add(["attempt_id"=>$attempt->id,"question_id"=>$question->id,"is_right"=>false,"is_answered"=>false]);
                }
            }
            $percentage = $point/$lesson->questions->count() * 100;
            if($percentage >= 80){
                PassedLesson::add(["uuid"=>Str::random(10) . $user->id, "attempt_id"=>$attempt->id,"user_id"=>$user->id,"lesson_id"=>$lesson->id]);
            }
            $attempt->edit(["points"=>$point]);
            return redirect()->route("exam-result",$attempt->id);
        }
        else{
          return  abort(404);
        }

    }

    public function examResult($attempt_id){
        if($attempt = UsersAttempt::where(["user_id" => auth()->id(),"id" => $attempt_id])->first()){
            $lesson = Lesson::with("course")->find($attempt->lesson_id);
            $questions = Question::where(["lesson_id" => $attempt->lesson_id])->get();
            $passed_questions = PassedQuestion::where(["attempt_id" => $attempt_id])->pluck("given_answer","question_id")->toArray();
            $passed_questions_results = PassedQuestion::where(["attempt_id" => $attempt_id])->pluck("is_right","question_id")->toArray();
            $passed_lessons = PassedLesson::where(["attempt_id" => $attempt_id])->first();
            return view("employee.quiz.quiz-result",compact("questions","lesson","passed_questions","passed_lessons","attempt","passed_questions_results"));
        }
        return abort(404);
    }
}
