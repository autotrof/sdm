<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request, $jenis)
    {
    	$data ['jenis'] = $jenis;
    	$data ['PARENTTAG'] = 'karyawan';
    	$data ['CHILDTAG'] = $jenis;
    	return view('pages.karyawan',$data);
    }
}
