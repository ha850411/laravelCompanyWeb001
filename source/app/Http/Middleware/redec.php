<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
class redec
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
         if ($request->session()->has('adminUser'))
         {
             $user = $request->session()->get('adminUser');
             return $next($request);
         }
         else
         {
           // return $next($request);
           return redirect('/login');
         }
     }

}
