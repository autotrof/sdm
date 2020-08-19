<?php

namespace App\Exports;

use App\Karyawan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class TesExport implements FromView, WithDrawings
{
    public function view(): View
    {
    	$data['list_karyawan'] = Karyawan::all();
        return view('exports.karyawan',$data);
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/dist/img/AdminLTELogo.png'));
        $drawing->setHeight(30);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
