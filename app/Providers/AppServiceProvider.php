<?php

namespace App\Providers;

use App\Models\Invite;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::if('admin', function (){
            return Auth::user()->role_id == 1 ? true : false;
        });
        Blade::if('employee', function (){
            return Auth::user()->role_id == 2 ? true : false;
        });
        Blade::if("notCandidate",function (){
            return Auth::user()->candidate != 1 ? true : false;
        });
        \view()->composer("menu",function ($view){
            if(Auth::check()){
                $invites = Invite::where('start', '<=', Carbon::now())->where('end', '>=', Carbon::now())->where("department_id",Auth::user()->department_id)->where(function ($q) {
                        $q->where("user_id", Auth::id());
                        $q->orWhere("user_id",null);
                    })->where("status", 0)->with(["department", "user", "type"])->whereNotIn("id", Auth::user()->results()->pluck("invites_id")->toArray())->get();
           $view->with("invitesCount",$invites->count());
            }

        });





    }
}
