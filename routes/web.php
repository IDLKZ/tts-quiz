<?php

use App\Http\Controllers\Employee\MainController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\MainController as adminMainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InviteController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Employee\SolovievQuizController;
use App\Http\Controllers\Employee\BelbinQuizController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Employee\TechSupportTicket;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect("/","/login");
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::group(["middleware"=>"guest"],function (){
   Route::get("/login",[AuthController::class,"login"])->name("login");
   Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

   Route::get("/forget",[AuthController::class,"forget"])->name("forget");
   Route::post("/restore",[AuthController::class,"restore"])->name("restore");

   Route::get("/recover/{token}",[AuthController::class,"recover"])->name("recover");
   Route::post("/new-password",[AuthController::class,'newPassword'])->name("newPassword");
});
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Application cache flushed";
});


//Start Admin
Route::group(["prefix"=>"admin", 'middleware' => ['auth', 'admin']],function (){
    Route::get('/', [adminMainController::class, 'index'])->name('adminHome');
    Route::get('/settings', [adminMainController::class, 'settings'])->name('adminSettings');
    Route::post('/update-profile', [adminMainController::class, 'updateProfile'])->name('adminUpdateProfile');
    Route::resource("company",CompanyController::class);
    Route::resource("department",DepartmentController::class);
    Route::resource("user",UserController::class);
    Route::resource("email",MailController::class);
    Route::get("/user-excel",[UserController::class,"excel"])->name("user-excel");
    Route::post("/upload-user",[UserController::class,"uploadExcel"])->name("upload-user");
    Route::resource("invite",InviteController::class);
    Route::resource("result",ResultController::class)->except([
        'create', 'store', 'update', 'edit'
    ]);
    Route::resource("/news",NewsController::class);
//    Result
    Route::get('/employee/{userId}/soloview-show/{id}', [adminMainController::class, 'solovievShow'])->name('admin-soloview-show');
    Route::get('/employee/{userId}/belbin-show/{id}', [adminMainController::class, 'belbinShow'])->name('admin-belbin-show');
    //PDF
    Route::get('/employee-pdf/{userId}/soloview-show/{id}', [PdfController::class, 'solovievShowPdf'])->name('admin-soloview-show-pdf');
    Route::get('/employee-pdf/{userId}/belbin-show/{id}', [PdfController::class, 'belbinShowPdf'])->name('admin-belbin-show-pdf');


    Route::get('/directory', [adminMainController::class, 'directory'])->name('adminDirectory');
    Route::post('/directory/get-users', [adminMainController::class, 'directoryGetUsers'])->name('adminDirectoryGetUsers');

    Route::get("/search",[SearchController::class,"search"])->name("search");
    Route::get("/result",[SearchController::class,"result"])->name("result-search");
    Route::resource("/course",\App\Http\Controllers\Admin\CourseController::class);
    Route::resource("/lesson",\App\Http\Controllers\Admin\LessonController::class);
    Route::resource("/question",\App\Http\Controllers\Admin\QuestionController::class);
    Route::resource("/event",\App\Http\Controllers\Admin\EventController::class);
    Route::resource("/forum",\App\Http\Controllers\Admin\ForumController::class)->except("edit","update");
    Route::resource("/forum-category",\App\Http\Controllers\Admin\ForumCategoryController::class);
    Route::resource("/literature-category",\App\Http\Controllers\Admin\LiteratureCategoryController::class);
    Route::resource("/literature",\App\Http\Controllers\Admin\LiteratureController::class);
    Route::resource("/document",\App\Http\Controllers\Admin\DocumentController::class);
    Route::resource("/document-category",\App\Http\Controllers\Admin\DocumentCategoryController::class);
    Route::resource("/task",\App\Http\Controllers\Admin\TaskController::class);
    Route::resource("/ticket-category",\App\Http\Controllers\Admin\TechSupportCategoryTicket::class);
    Route::resource("/ticket",\App\Http\Controllers\Admin\TicketController::class);
    Route::resource("/admin-ideas",\App\Http\Controllers\Admin\IdeaController::class);
    Route::resource("/admin-schedule",\App\Http\Controllers\Admin\ScheduleController::class);

    Route::get("/all-result",[\App\Http\Controllers\Admin\MainController::class,"allResult"])->name("all-result");
});
//Start Employee
Route::group(['prefix' => 'employee', 'middleware' => ['auth', 'employee']], function (){
    Route::get('/', [MainController::class, 'index'])->name('employeeHome');
    Route::get('/home', [MainController::class, 'home'])->name('employeeMainPage');
    Route::get("/my-invites",[MainController::class,"invite"])->name("invite");
    Route::get('/settings', [MainController::class, 'settings'])->name('employeeSettings');
    Route::post('/update-profile', [MainController::class, 'updateProfile'])->name('employeeUpdateProfile');
    //Soloviev Quiz
    Route::get("/soloviev-quiz/{id}",[SolovievQuizController::class,"show"])->name("solovievQuiz")->whereNumber("id");
    Route::get("/soloviev-pass/{id}",[SolovievQuizController::class,"pass"])->name("solovievPass")->whereNumber("id");
    Route::post("/soloviev-check",[SolovievQuizController::class,"check"])->name("solovievCheck");

    Route::get("/belbin-quiz/{id}",[BelbinQuizController::class,"show"])->name("belbinQuiz");
    Route::get("/belbin-pass/{id}",[BelbinQuizController::class,"pass"])->name("belbinPass")->whereNumber("id");

    Route::get("/my-results",[MainController::class,"results"])->name("my-results")->middleware("candidate");
    Route::get("/soloviev-show/{id}",[MainController::class,"solovievShow"])->name("soloviev-show")->whereNumber("id")->middleware("candidate");
    Route::get("/belbin-show/{id}",[MainController::class,"belbinShow"])->name("belbin-show")->whereNumber("id")->middleware("candidate");

    Route::get('/directory', [MainController::class, 'directory'])->name('employeeDirectory')->middleware("candidate");
    Route::post('/directory/get-users', [MainController::class, 'directoryGetUsers'])->name('employeeDirectoryGetUsers')->middleware("candidate");
    Route::get("/employee-news",[MainController::class,"news"])->name("employee-news")->middleware("candidate");
    Route::get("/news-show/{id}",[MainController::class,"newsOne"])->name("news-show")->middleware("candidate");
    Route::get("/course-list",[MainController::class,"courses"])->name("courseListEmployee");
    Route::get("/course-show-employee/{alias}",[MainController::class,"showCourse"])->name("course-show-employee");
    Route::get("/employee-tasks",[MainController::class,"tasks"])->name("employee-tasks");
    Route::get("/employee-task-detail/{id}",[MainController::class,"taskDetail"])->name("employee-task-detail");
    Route::delete("/employee-task-delete/{id}",[MainController::class,"taskDelete"])->name("employee-task-delete");
    Route::get("/employee-task-create",[MainController::class,"taskCreate"])->name("employee-task-create");
    Route::post("/employee-task-store",[MainController::class,"taskStore"])->name("employee-task-store");
    Route::get("/lesson-show/{alias}",[MainController::class,"showLesson"])->name("lesson-show-employee");
    Route::get("/forum-list",[MainController::class,"forumList"])->name("forum-list");
    Route::get("/forum-detail/{id}",[MainController::class,"forumDetail"])->name("forumDetail");
    Route::get("/forum-create",[MainController::class,"forumCreate"])->name("forumCreate");
    Route::post("/forum-employee-store",[MainController::class,"forumStore"])->name("forum-employee-store");
    Route::get("/employee-profile",[MainController::class,"employeeProfile"])->name("employee-profile");
    Route::get("/literatures-lists",[MainController::class,"literatureLists"])->name("literatures-lists");
    Route::get("/document-lists",[MainController::class,"documentLists"])->name("document-lists");
    Route::get("/literatures-show/{id}",[MainController::class,"literatureShow"])->name("literaturesShow");
    Route::get("/tech-support-tickets",[TechSupportTicket::class,"index"])->name("tech-support-ticket-list");
    Route::get("/tech-support-tickets-create",[TechSupportTicket::class,"create"])->name("tech-support-ticket-create");
    Route::post("/tech-support-tickets-store",[TechSupportTicket::class,"store"])->name("tech-support-ticket-store");
    Route::get("/tech-support-tickets-show/{id}",[TechSupportTicket::class,"show"])->name("tech-support-ticket-show");
    Route::get("/pass-quiz-by-lesson/{id}",[\App\Http\Controllers\Employee\QuizController::class,"passQuiz"])->name("pass-quiz-by-lesson");
    Route::post("/pass-exam",[\App\Http\Controllers\Employee\QuizController::class,"passExam"])->name("pass-exam");
    Route::get("/exam-result/{attempt_id}",[\App\Http\Controllers\Employee\QuizController::class,"examResult"])->name("exam-result");
    Route::post("/tech-support-tickets-edit/{id}",[TechSupportTicket::class,"update"])->name("tech-support-ticket-update");
    Route::get("/event-all",[MainController::class,"events"])->name("event-all");
    Route::get("/event-info/{id}",[MainController::class,"eventShow"])->name("event-show");
    Route::resource("/employee-idea",\App\Http\Controllers\Employee\IdeaController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::post('/get-department', [HomeController::class, 'getDepartment']);
    Route::get('/get-employees/{id}', [HomeController::class, 'getEmployee'])->name('employee-getUser');
    Route::post('image-upload', [\App\Http\Controllers\ImageController::class, 'storeImage'])->name('image.upload');
});
