<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request){

        if (Auth::attempt($request->only('email','password'))) {
            return redirect()->route('index');
        }
        return redirect()->back();
    }
}
