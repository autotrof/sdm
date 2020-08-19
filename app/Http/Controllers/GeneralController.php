<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class GeneralController extends Controller
{
    public function loginPage(Request $request)
    {
    	return view('login');
    }

    public function cekLogin(Request $request)
    {
    	$credentials = $request->only('email', 'password');
        if(\Auth::attempt($credentials)){
            return response()->json(true);
        }
    	return response()->json('Email atau password tidak cocok');
    }

    public function logout(Request $request)
    {
    	\Auth::logout();
    	return redirect('/login');
    }
}
