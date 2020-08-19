<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
    	$data ['PARENTTAG'] = 'organisasi';
    	return view('pages.organisasi',$data);
    }
}
