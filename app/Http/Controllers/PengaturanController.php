<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index(Request $request)
    {
    	$data ['PARENTTAG'] = 'pengaturan';
    	return view('pages.pengaturan',$data);
    }
}
