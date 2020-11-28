<?php

namespace App\Http\Middleware;

use Closure;

class IsAjaxRequest
{
    public function handle($request, Closure $next)
    {
        if(!$request->ajax()){
            return response()->view('backend.404');
        }
        return $next($request);
    }
}
