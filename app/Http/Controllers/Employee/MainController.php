<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Employee;
use App\Http\Requests\Forum\ForumCreateRequest;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Models\BelbinQuiz;
use App\Models\BelbinUser;
use App\Models\Company;
use App\Models\Course;
use App\Models\Department;
use App\Models\Event;
use App\Models\Forum;
use App\Models\Invite;
use App\Models\JobMotive;
use App\Models\Lesson;
use App\Models\Literature;
use App\Models\Motive;
use App\Models\News;
use App\Models\Questionnaire;
use App\Models\QuestionnaireQuestion;
use App\Models\QuestionnaireResult;
use App\Models\Result;
use App\Models\Schedule;
use App\Models\Task;
use App\Models\User;
use App\Models\UserMeaning;
use App\Models\UserMotivation;
use App\Models\UserMotive;
use App\Models\UsersAttempt;
use App\Models\UserScale;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('employee.index', compact('user'));
    }

    public function home(){
        $news = News::where(["is_main"=>true])->orderBy("created_at","desc")->first();
        $tasks = Task::with(["department","user"])->whereJsonContains("users",\auth()->id())->orderBy("created_at","desc")->take(4)->get();
        $users = User::whereMonth("birth_date","=",Carbon::now()->month)->orderBy("birth_date","asc")->take(4)->get();
        $forums = Forum::with(["user"])->withCount(["forum_ratings","forum_messages"])->orderBy("created_at","desc")->take(4)->get();
        $events = Event::orderBy("created_at","desc")->take(4)->get();
        return view('employee.home.index',compact("news","tasks","users","forums","events"));
    }

    public function settings()
    {
        $jsValidator = JsValidator::make(
            [
                "name" => "required",
                "img" => "sometimes|image|max:4096",
                "phone" => "required|max:255",
                'password' => 'sometimes|min:4'
            ]
        );
        return view('employee.settings', compact('jsValidator'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, ["name" => "required|max:255", "phone" => "required|max:255", "img" => "sometimes|image|max:4096", "password" => "sometimes|nullable|min:4|max:255"]);
        $user = User::find(Auth::id());
        $request['role_id'] = 2;
        if (User::updateData($request, $user)) {
            toastSuccess('Успешно обновлен!');
            return redirect(route('employeeHome'));
        } else {
            toastError('Что то пошло не так!');
            return redirect()->back();
        }
    }

    public function invite()
    {
        $results = Auth::user()->results()->pluck("invites_id")->toArray();

        $invites = Invite::where('start', '<=', Carbon::now())->where('end', '>=', Carbon::now())->where("department_id",Auth::user()->department_id)->where(function ($q) {
            $q->where("user_id", Auth::id());
            $q->orWhere("user_id",null);
        })->where("status", 0)->with(["department", "user", "type"])->whereNotIn("id", $results)->orderBy("created_at","DESC")->paginate(15);
        return view("employee.invite.index", compact("invites"));
    }

    public function results()
    {
        $results = Result::where("user_id", Auth::id())->with(["invite", "job", "user"])->orderBy("pass_time", "DESC")->paginate(15);
        return view("employee.result.index", compact("results"));
    }

    public function solovievShow($id)
    {
        $result = Result::where(["user_id" => Auth::id()])->with(["job", "user"])->find($id);
        if ($result) {
            $invite = Invite::where(function ($q) {
                $q->where("user_id", Auth::id());
                $q->orWhere("department_id", Auth::user()->department_id);
            })->where("visible",1)->with(["department", "type"])->find($result->invites_id);
            if ($invite) {
                $meaning = UserMeaning::where("result_id", $result->id)->with(["result"])->get();
                $motivation = UserMotivation::where("result_id", $result->id)->get();
                $motives = UserMotive::where("result_id", $result->id)->with("motive")->get();
                $scales = UserScale::where("result_id", $result->id)->with("scale")->get();
                $job_motive = JobMotive::where("job_id", $result->job_id)->get()->groupBy("motive_id")->toArray();
                $all_motives = collect(Motive::get()->groupBy("id")->toArray());
                if ($invite->type_id == 1 && $meaning->isNotEmpty() && $motivation->isNotEmpty() && $motives->isNotEmpty() && $scales->isNotEmpty() && count($job_motive) && count($all_motives)) {
                    return view("employee.result.soloviev-show", compact("result", "meaning", "motivation", "motives", "scales", "job_motive", "invite", "all_motives"));
                }
                abort(404);

            } else {
                abort(404);
            }

        } else {
            abort(404);
        }


    }

    public function belbinShow($id)
    {
        $result = Result::where(["user_id" => Auth::id()])->with(["job", "user"])->find($id);
        if ($result) {
            $invite = Invite::where(function ($q) {
                $q->where("user_id", Auth::id());
                $q->orWhere("department_id", Auth::user()->department_id);
            })->where("visible",1)->with(["department", "type"])->find($result->invites_id);
            if ($invite) {
                $quiz = BelbinQuiz::first();
                $belbin_user = BelbinUser::where("result_id", $result->id)->with("belbinRole")->get();
                if ($belbin_user->isNotEmpty() && $invite->type_id == 2) {
                    return view("employee.result.belbin-show", compact("result", "invite", "belbin_user"));
                } else {
                    abort(404);
                }

            }
            abort(404);
        } else {
            abort(404);
        }

    }

    public function directory()
    {
        $companies = Company::all();
        return view('directory.directory', compact('companies'));
    }

    public function directoryGetUsers(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required|exists:departments,id'
        ]);
        $users = User::where('department_id', $request->get('department_id'))->with('department')->paginate(20);
        return view('directory.show', compact('users'));
    }

    public function news()
    {
        $actual = News::orderBy("created_at", "DESC")->first();
        $news = News::orderBy("created_at", "DESC")->paginate(15);
        return view("employee.news.index", compact("news", 'actual'));
    }

    public function newsOne($id)
    {
        if ($news = News::find($id)) {
            return view("employee.news.show", compact("news"));
        } else {
            abort(404);
        }
    }

    public function courses()
    {
        $courses = Course::where(["departments" => null])->orWhereJsonContains("departments",\auth()->user()->department_id)->paginate(24);
        return view("employee.course.index", compact('courses'));
    }

    public function showCourse($alias)
    {
        if ($course = Course::where(["alias" => $alias])->with(["lessons"])->first()) {
            return view("employee.course.show", compact("course"));
        } else {
            abort(404);
        }
    }

    public function showLesson($alias)
    {
        if ($lesson = Lesson::where(["alias" => $alias])->withCount("questions")->with(["prev_lesson","next_lesson","course"])->first()) {
            $other_lessons = Lesson::where("order",">",$lesson->order)->orWhere("order","<",$lesson->order)->orderBy("order","asc")->with(["prev_lesson","next_lesson","course"])->take(3)->get();
            return view("employee.lesson.show", compact("lesson","other_lessons"));
        } else {
            abort(404);
        }
    }

    public function tasks(){
        $tasks = Task::with(["department","user"])->whereJsonContains("users",\auth()->id())->get()->groupBy("status");
        return view("employee.task.index", compact("tasks"));
    }
    public function taskDetail($id){
        $task = Task::with(["department","user"])
            ->where(["id"=>$id])
            ->where(function (Builder $query) {
                $query->whereJsonContains("users",\auth()->id())->orWhere(["user_id" => \auth()->user()->id]);
            })
            ->first();
        if($task){
            return view("employee.task.show", compact("task"));
        }
        abort(404);
    }
    public function taskDelete($id){
        $task = Task::where(["user_id" => \auth()->user()->id,"id"=>$id])
            ->first();
        if($task){
            $task->delete();
        }
        return redirect()->back();
    }

    public function taskCreate(){
        return view("employee.task.create");
    }

    public function taskStore(TaskCreateRequest $request){
            try{
                $input = $request->all();
                $input["user_id"] = \auth()->id();
                $input["start_date"] = \Carbon\Carbon::createFromFormat('d/m/Y H:i',$request["start_date"]);
                if($input["end_date"]){
                    $input["end_date"] = Carbon::createFromFormat('d/m/Y H:i',$request["end_date"]);
                }
                $input["users"] = json_decode($input["users"],true);
                $input["users"] = array_map('intval', $input["users"]);
                $task = Task::add($input);
            }
            catch (\Exception $exception){

            }
            return redirect()->route("employee-tasks");
    }

    public function forumList(){
        $forums = Forum::with(["user"])->withCount(["forum_ratings","forum_messages"])->orderBy("created_at","desc")->paginate(20);
        return view("employee.forum.index", compact("forums"));
    }

    public function forumDetail($id){
        try{
            $forum = Forum::
            withSum("forum_ratings","rating")
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
                ->with(["user.department","category"])
                ->withCount("forum_messages")
                ->find($id);
            if($forum){
                return view("employee.forum.show",compact("forum"));
            }
        }
        catch (\Exception $exception){

        }
        return abort(404);
    }
    public function forumCreate(){
        return view("employee.forum.create");
    }
    public function forumStore(ForumCreateRequest  $request){
        try{
            $input = $request->all();
            $input["user_id"] = auth()->id();
            $forum = Forum::add($input);
            return redirect()->route("forumDetail",$forum->id);
        }
        catch (\Exception $exception){

        }
        return redirect()->route("forum-list");
    }
    public function literatureLists(){
        return view("employee.literature.index");
    }

    public function documentLists(){
        return view("employee.document.index");
    }

    public function literatureShow($id){
        try{
            $literature = Literature::with("literature_category")->find($id);
            if($literature){
               return view("employee.literature.show",compact("literature"));
            }
        }
        catch (\Exception $exception){

        }
        return abort(404);
    }

    public function employeeProfile(){
        $user = Auth::user();
        $tasks = Task::with(["department","user"])->whereJsonContains("users",\auth()->id())->orderBy("created_at","desc")->take(4)->get();
        $forums = Forum::with(["user"])->withCount(["forum_ratings","forum_messages"])->orderBy("created_at","desc")->take(4)->get();
        $events = Event::orderBy("created_at","desc")->take(4)->get();
        $attempts = UsersAttempt::where(["user_id" => \auth()->id()])->with(["user","lesson","passed_lessons"])->orderBy("created_at","desc")->paginate(10);
        $schedules = Schedule::where(["user_id" => \auth()->id()])->where("start_at","<=",Carbon::now()->startOfDay())->where("end_at",">=",Carbon::now()->startOfDay())->with(["user.department"])->get();
        return view("employee.home.my-profile",compact("tasks","forums","events","user","attempts","schedules"));
    }

    public function events(){
        $events = Event::orderBy("created_at","desc")->paginate(20);
        return view("employee.event.index",compact("events"));
    }
    public function eventShow($id){
        $event = Event::find($id);
        if(!$event){
            abort(404);
        }
        return view("employee.event.show",compact("event"));
    }
    public function listQuestionnaires()
    {
        $questionnaires = Questionnaire::where("start_at","<",Carbon::now())->where("end_at",">",Carbon::now())->paginate(15);
        return view("employee.questionnaire.index",compact("questionnaires"));
    }
    public function showQuestionnaire($id)
    {
        $questionnaire = Questionnaire::where("start_at","<",Carbon::now())->where("end_at",">",Carbon::now())->withCount("questionnaire_questions")->find($id);
        $result = QuestionnaireResult::where(["user_id" => \auth()->id(),"questionnaire_id" => $id])->first();
        if(!$questionnaire){
            abort(404);
        }
        return view("employee.questionnaire.show",compact("questionnaire","result"));
    }
    public function passQuestionnaire($id)
    {
        $questionnaire = Questionnaire::where("start_at","<",Carbon::now())->where("end_at",">",Carbon::now())->withCount("questionnaire_questions")->find($id);
        $questions = QuestionnaireQuestion::where(["questionnaire_id" => $questionnaire->id])->with("questionnaire_answers")->get();
        $result = QuestionnaireResult::where(["user_id" => \auth()->id(),"questionnaire_id" => $id])->first();
        if(!$questionnaire || $result || count($questions) == 0){
            abort(404);
        }
        return view("employee.questionnaire.pass",compact("questionnaire","questions"));
    }

    public function checkQuestionnaire(Request $request)
    {
        $this->validate($request,["questionnaire_id"=>"exists:questionnaires,id","answer"=>"required|array"]);
        $questionnaire_id = (int)$request->get("questionnaire_id");
        $answer = $request->get("answer");
        $raw = [];
        foreach ($answer as $questionID => $answerID){
            $answerID = (int)$answerID;
            $data = [
                'questionnaire_id'=>$questionnaire_id,
                'question_id'=>$questionID,
                'answer_id'=>$answerID,
                'department_id'=>\auth()->user()->department_id,
                'user_id'=>\auth()->id()
            ];
            array_push($raw,$data);
        }
        QuestionnaireResult::insert($raw);
        toastSuccess("Спасибо за ваше мнение!");
        return redirect()->route("employee-questionnaire-show",$questionnaire_id);

    }
}
