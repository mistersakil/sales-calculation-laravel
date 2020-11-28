<?php

namespace App\Services;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class RouteService
{
    ## Route List ##
    public function route_list(){

        $actionName = request()->route()->getActionname();
        $permissions = []; 
        /* iterate though all routes */
        foreach (Route::getRoutes()->getRoutes() as $key => $route)
        {
             /** get route action **/
             $action = $route->getActionname();
             $action_array = explode('@',$action);
             
             $controller = $method = '';
             if(Str::containsAll(Arr::first($action_array),['Backend','Controller'])){
                $controller = Arr::first($action_array);
                $controller = substr($controller,strrpos($controller, '\\')+1);
                $controller = strstr($controller,'Controller',true);
                $method = Arr::last($action_array);
                $permissions[Str::snake($controller)][] = strtolower($method);
             }

        }
        ksort($permissions);
        return ($permissions);
    }

}
