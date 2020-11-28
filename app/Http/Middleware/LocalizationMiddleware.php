<?php

namespace App\Http\Middleware;

use Closure;

class LocalizationMiddleware
{
   
    public function handle($request, Closure $next)
    {
        if(session()->has('locale')){
            app()->setLocale(session('locale'));
        }else{
            app()->setLocale('en');
        }
        return $next($request);
    }
}
