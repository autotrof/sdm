<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
    	$data ['PARENTTAG'] = 'user';
    	return view('pages.user',$data);
    }

    public function data(Request $request)
    {
    	$orderBy = 'users.nama';
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'users.nama';
                break;
            case "2":
                $orderBy = 'users.email';
                break;
        }

        $data = User::select([
            'users.id',
            'users.nama',
            'users.email',
            'users.created_at'
        ])
        ;

        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(users.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(users.email) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }

        $recordsFiltered = $data->get()->count();
        if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        $data = $data->orderBy($orderBy,$request->input('order.0.dir'))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ]);
    }

    public function store(Request $request)
    {
    	$request->merge([
    		'password'=>bcrypt($request->password),
    		'created_at'=>date('Y-m-d H:i:s')
    	]);
    	$user = new User($request->only(['nama','email','password']));
    	$user->save();
    	return response()->json(true);
    }

    public function edit(Request $request)
    {
    	$user = User::where('id',$request->id)->first();
    	$user->nama = $request->nama;
    	$user->email = $request->email;
    	$user->updated_at = date('Y-m-d H:i:s');
    	if($request->password){
    		$user->password = bcrypt($request->password);
    	}
    	$user->save();
    	return response()->json(true);
    }

    public function hapus($id)
    {
    	if($id==\Auth::user()->id) return response()->json(false);
    	User::where('id',$id)->delete();
    	return response()->json(true);
    }

    public function hapusBeberapa(Request $request)
    {
    	User::whereIn('id',$request->input('ids'))->where('id','<>',\Auth::user()->id)->delete();
    	return response()->json(true);
    }
}
