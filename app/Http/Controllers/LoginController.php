<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function postLogin(Request $request){

        //Validate username and password
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);

        //Check auth admin and user
        if(Auth::guard('admin')->attempt($request->only('username','password'))){
            return redirect('/dashboard')->with('success','Login success!');
        }elseif(Auth::guard('user')->attempt($request->only('username','password'))){
            return redirect('/dashboard')->with('success','Login success!');
        }

        return redirect('/login')->with('error','Login failed');
    }

    public function logout(Request $request){

        //Check auth admin and user for logout
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            
            $request->session()->invalidate();
 
            $request->session()->regenerateToken();

        }elseif(Auth::guard('user')->check()){
            Auth::guard('user')->logout();

            $request->session()->invalidate();
 
            $request->session()->regenerateToken();
        }

        return redirect('/');
    }
}
