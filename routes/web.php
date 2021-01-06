<?php

use App\Http\Controllers\Employee\MainController;
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


//Start Admin
Route::group(["prefix"=>"admin", 'middleware' => ['auth', 'admin']],function (){
    Route::get('/', [adminMainController::class, 'index'])->name('adminHome');
    Route::get('/settings', [adminMainController::class, 'settings'])->name('adminSettings');
    Route::post('/update-profile', [adminMainController::class, 'updateProfile'])->name('adminUpdateProfile');
    Route::resource("company",CompanyController::class);
    Route::resource("department",DepartmentController::class);
    Route::resource("user",UserController::class);
    Route::resource("invite",InviteController::class);
    Route::resource("result",ResultController::class)->except([
        'create', 'store', 'update', 'edit'
    ]);
    Route::get('/employee/{userId}/soloview-show/{id}', [adminMainController::class, 'solovievShow'])->name('admin-soloview-show');
    Route::get('/employee/{userId}/belbin-show/{id}', [adminMainController::class, 'belbinShow'])->name('admin-belbin-show');
});
//Start Employee
Route::group(['prefix' => 'employee', 'middleware' => ['auth', 'employee']], function (){
    Route::get('/', [MainController::class, 'index'])->name('employeeHome');
    Route::get("/my-invites",[MainController::class,"invite"])->name("invite");
    Route::get('/settings', [MainController::class, 'settings'])->name('employeeSettings');
    Route::post('/update-profile', [MainController::class, 'updateProfile'])->name('employeeUpdateProfile');
    //Soloviev Quiz
    Route::get("/soloviev-quiz/{id}",[SolovievQuizController::class,"show"])->name("solovievQuiz")->whereNumber("id");
    Route::get("/soloviev-pass/{id}",[SolovievQuizController::class,"pass"])->name("solovievPass")->whereNumber("id");
    Route::post("/soloviev-check",[SolovievQuizController::class,"check"])->name("solovievCheck");

    Route::get("/belbin-quiz/{id}",[BelbinQuizController::class,"show"])->name("belbinQuiz");
    Route::get("/belbin-pass/{id}",[BelbinQuizController::class,"pass"])->name("belbinPass")->whereNumber("id");

    Route::get("/my-results",[MainController::class,"results"])->name("my-results");
    Route::get("/soloviev-show/{id}",[MainController::class,"solovievShow"])->name("soloviev-show")->whereNumber("id");
    Route::get("/belbin-show/{id}",[MainController::class,"belbinShow"])->name("belbin-show")->whereNumber("id");


});

