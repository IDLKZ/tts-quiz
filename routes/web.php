<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InviteController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return Route::redirect("/login");
});

Route::group(["middleware"=>"guest"],function (){
   Route::get("/login",[AuthController::class,"login"])->name("login");
   Route::get("/forget",[AuthController::class,"forget"])->name("forget");
   Route::post("/restore",[AuthController::class,"restore"])->name("restore");

});


//Start Admin
Route::group(["prefix"=>"admin"],function (){
    Route::resource("company",CompanyController::class);
    Route::resource("department",CompanyController::class);
    Route::resource("user",UserController::class);
    Route::resource("invite",InviteController::class);
    Route::resource("result",ResultController::class)->except([
        'create', 'store', 'update', 'edit'
    ]);
});


