<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $guarded = [''];

    function karyawan()
    {
    	return $this->belongsTo('\App\Karyawan','karyawan_id');
    }
}
