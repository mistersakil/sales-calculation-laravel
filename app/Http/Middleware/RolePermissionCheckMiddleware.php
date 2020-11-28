<?php

namespace App\Http\Middleware;

use Closure;

class RolePermissionCheckMiddleware
{
    
    public function handle($request, Closure $next)
    {
        $class_basename = class_basename($request->route()->getActionname());
        $permission_for = strtolower(strstr($class_basename,'Controller',true));
        $permission_name = strtolower(substr($class_basename,strrpos($class_basename, '@')+1 ));
        $is_approved  = false;
        $loggedin_user = auth()->user();        

        /*  Check logged user has any role */
        if($loggedin_user->has_any_role()){
            if($loggedin_user->has_any_permission()){
                $for = $loggedin_user->match_permission($permission_for, $permission_name);
                $true = (bool) $for;
                if($true === true){
                    $is_approved = true;
                }else{
                    $is_approved = false;                    
                }
            }else{
                $is_approved = false;
            }
        }

        if( $is_approved  ){
            return $next($request);
        }
        return response()->view('backend.403');
    }
}
