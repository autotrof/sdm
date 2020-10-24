<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presensi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PresensiImport;
use App\Exports\PresensiExport;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
    	$data ['PARENTTAG'] = 'presensi';
    	return view('pages.presensi',$data);
    }

    public function data(Request $request)
    {
    	$orderBy = 'presensi.tanggal';
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'presensi.tanggal';
                break;
            case "2":
                $orderBy = 'karyawan.nik';
                break;
            case "3":
                $orderBy = 'presensi.masuk';
                break;
            case "4":
                $orderBy = 'presensi.pulang';
                break;
            case "4":
                $orderBy = 'presensi.status';
                break;
		}

        $data = Presensi::select([
            'presensi.*',
            'karyawan.nama',
            'karyawan.nik'
        ])
        ->join('karyawan','karyawan.id','=','presensi.karyawan_id')
        ;

        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(karyawan.nik) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(karyawan.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(presensi.status) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(presensi.tanggal) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(presensi.masuk) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(presensi.pulang) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }

        /*if($request->input('organisasi')!=null){
            $data = $data->where('organisasi_id',$request->organisasi);
        }
        if($request->input('bpjs_kesehatan')!=null){
            if($request->input('bpjs_kesehatan')==1){
                $data = $data->whereNotNull('nomor_bpjs_kesehatan');
            }else if($request->input('bpjs_kesehatan')==0){
                $data = $data->whereNull('nomor_bpjs_kesehatan');
            }
        }
        if($request->input('bpjs_ketenagakerjaan')!=null){
            if($request->input('bpjs_ketenagakerjaan')==1){
                $data = $data->whereNotNull('nomor_bpjs_ketenagakerjaan');
            }else if($request->input('bpjs_ketenagakerjaan')==0){
                $data = $data->whereNull('nomor_bpjs_ketenagakerjaan');
            }
        }*/

        $recordsFiltered = $data->get()->count();
        if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        $data = $data
        ->orderBy($orderBy,$request->input('order.0.dir'))
        ->orderBy('created_at','desc')
        ->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ]);
    }

	public function importDataPresensi(Request $request)
    {
        $file = $request->file('excel-presensi');
        \DB::beginTransaction();
        Excel::import(new PresensiImport,$file);
        \DB::commit();
        return redirect()->back();
    }
}
