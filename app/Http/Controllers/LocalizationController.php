<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index($locale){
    	app()->setLocale($locale);
    	## set locale at session to retrive from all routes protected by middleware ##
    	if($locale != 'en'){
    		session()->put('locale',$locale);
    	}else{
    		session()->forget('locale');    		
    	}
    	return redirect()->back();
    }
}
