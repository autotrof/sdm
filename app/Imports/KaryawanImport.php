<?php

namespace App\Imports;

use App\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = date('Y-m-d H:i:s');
        return new Karyawan([
            'nama'=>$row['nama'],
            'nomor_ktp'=>$row['nomor_ktp'],
            'nik'=>$row['nik'],
            'telp'=>$row['telp'],
            'email'=>$row['email'],
            'detail_alamat'=>$row['detail_alamat'],
            'status'=>$row['status'],
            'nomor_bpjs_kesehatan'=>$row['nomor_bpjs_kesehatan'],
            'nomor_bpjs_ketenagakerjaan'=>$row['nomor_bpjs_ketenagakerjaan'],
            'created_at'=>$now,
            'organisasi_id'=>$row['organisasi_id']
        ]);
    }
}
