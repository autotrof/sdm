<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
    	$data ['PARENTTAG'] = 'presensi';
    	return view('pages.presensi',$data);
    }
}
