<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Karyawan;

class KaryawanExport implements FromQuery, WithHeadings, WithMapping
{
    protected $list_id = [];
    function __construct($list_id=[]) {
        $this->list_id = $list_id;
    }

    public function query()
    {
        $data = Karyawan::query();
        if(count($this->list_id)>0) $data = $data->whereIn('id',$this->list_id);
        return $data;
    }

	public function headings(): array
    {
        return [
            'nama',
			'nomor_ktp',
			'nik',
			'telp',
			'email',
			'detail_alamat',
			'status',
			'nomor_bpjs_kesehatan',
			'nomor_bpjs_ketenagakerjaan',
			'organisasi_id'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($karyawan): array
    {
        return [
            $karyawan->nama,
            $karyawan->nomor_ktp,
            $karyawan->nik,
            $karyawan->telp,
            $karyawan->email,
            $karyawan->detail_alamat,
            $karyawan->status,
            $karyawan->nomor_bpjs_kesehatan,
            $karyawan->nomor_bpjs_ketenagakerjaan,
            $karyawan->organisasi_id,
        ];
    }
}
