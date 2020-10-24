<?php

namespace App\Imports;

use App\Karyawan;
use App\Presensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PresensiImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
        	$karyawan = Karyawan::where('nik',$row[0])->first();
        	if($karyawan!=null){
        		Presensi::updateOrCreate(
	            [
	            	'karyawan_id' => $karyawan->id,
	                'tanggal' => $row[1]
	            ],
	            [
	                'masuk' => $row[1].' '.$row[2].':00',
	                'pulang' => $row[1].' '.$row[3].':00',
	                'status' => $row[4]
	            ]
	        	);
        	}
        }
    }
}
