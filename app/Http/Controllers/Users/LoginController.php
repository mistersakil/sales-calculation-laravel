<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\FrontendController;
use App\Model\User;
use Auth, Validator;
use Illuminate\Http\Request;

class LoginController extends FrontendController
{
    /* Display login page */

    public function __construct(){
    	$this->middleware('guest:web')->except('logout');
    }

    public function show_login_form()
    {   
        return view('users.show_login_form');
    }


    public function login(Request $request){
    	
        $credentials = Validator::make($request->only('email', 'password'), [
            'email'     => 'required|email',
            'password'  => 'required',
        ])->validate();

        if (Auth::guard('web')->attempt($credentials,true)) {
            session(['loggedin_user' => User::with('roles')->findOrFail(auth()->user()->id)]);
            return redirect()->route('admin.dashboard');
        }else{
        	return redirect()->back()->with('alert','We could not match your given email and password')->with(['credentials' => $credentials]);
        }
    	// dd($request->all());
    }
    public function logout(){
    	Auth::logout();
    	return redirect()->route('users.show_login_form');
    }
    
}
