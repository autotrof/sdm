<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisasi;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
    	$data ['PARENTTAG'] = 'organisasi';
    	return view('pages.organisasi',$data);
    }

    private function parse($array){
        $hasil = [];
        foreach ($array as $value) {
            $data = [
                'id'=>$value['id'],
                'name'=>$value['nama'],
                'title'=>$value['nama'],
                'children'=>[]
            ];
            if (!empty($value['children'])) { 
                $data['children'] = $this->parse($value['children']);
            }
            array_push($hasil, $data);
        }
        return $hasil;
    }

    public function data(Request $request)
    {
    	$data = Organisasi::with('children')->doesnthave('allParents')->get()->toArray();
        $data = $this->parse($data);
        $data = [
            'name'=>"Struktur Organisasi",
            'title'=>'PT. ORGANISASI ANDA',
            'children'=>$data
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
    	$organisasi = new Organisasi($request->only('nama','parent_id'));
    	$organisasi->save();
    	return response()->json(true);
    }

    public function show(Request $request,$id)
    {
    	$data = Organisasi::select(['id','nama as text']);
    	if($request->search){
    		$data = $data->where('nama','like','%'.$request->search.'%');
    	}
    	$data = $data
    	->orderBy('id','desc')
    	->get()
    	->toArray()
    	;
    	return response()->json([
    		'results'=>$data
    	]);
    }

    public function showOne($id)
    {
        return response()->json(Organisasi::with('parents')->find($id));
    }

    public function edit(Request $request)
    {
        $organisasi = Organisasi::find($request->id);
        $organisasi->parent_id = $request->parent_id;
        $organisasi->nama = $request->nama;
        $organisasi->save();
        return response()->json($organisasi);
    }

    public function hapus($id)
    {
        Organisasi::where('id',$id)->delete();
        return response()->json(true);
    }
}
