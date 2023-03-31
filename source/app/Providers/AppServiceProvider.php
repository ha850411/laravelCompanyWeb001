<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Session;

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
        date_default_timezone_set("Asia/Taipei");
        view()->composer('*',function($view) {
          if(!empty(Session::get('adminUser')))
          {
            // $tip = DB::table('fixed')->where('tip','0')->get() ;
            // $res = [];
            // foreach($tip as $kk=>$val)
            // {
            //   $tip = '-'.$val->warranty.' months';
            //   $day = date('Y-m-d',strtotime($tip)) . ' 23:59:59';
            //   $tip = DB::table('fixed')->where('createDate','<=',$day)->where('id',$val->id)->first() ;
            //   if($tip)
            //   {
            //     $customer = DB::table("company")->where('id',$val->customer)->first();
            //     if(!empty($customer->name))
            //     {
            //       $tip->customer = $customer->name;
            //     }
            //     else {
            //       $tip->customer = '無';
            //     }
            //     array_push($res,$tip);
            //   }
            // }
            $view->with('count', 0);
            $view->with('tip', []);
          }
        });
    }
}
