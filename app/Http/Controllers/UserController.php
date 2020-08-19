<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
    	$data ['PARENTTAG'] = 'user';
    	return view('pages.user',$data);
    }
}
