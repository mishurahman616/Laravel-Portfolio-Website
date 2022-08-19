<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function loginIndex(){
        return view('login');
    }
    function onLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'pass'=>'required|string',
        ]);
        $email=$request->input('email');
        $pass=$request->input('pass');
        $result=User::where('email','=', $email)->where('password', '=', $pass)->count();
        if($result==1){
            $request->session()->put('user', $email);
            return 1;
        }else{
            return 0;
        }
    }

    function onLogout(Request $request){
        $request->session()->flush();
        return redirect('login');
    }
}
