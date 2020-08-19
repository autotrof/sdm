<?php

use Illuminate\Database\Seeder;
use \App\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data_karyawan = [];
        
        for($i=1;$i<=200;$i++){
        	$faker = \Faker\Factory::create('id_ID');
        	$data = [
        		'nama'=>$faker->name,
	            'nomor_ktp'=>$faker->numerify('################'),
	            'nik'=>$faker->numerify('##########'),
	            'telp'=>$faker->phoneNumber,
	            'email'=>$faker->email,
	            'detail_alamat'=>$faker->address,
	            'foto'=>null,
	            'status'=>$faker->randomElement(['aktif','non aktif']),
	            'nomor_bpjs_kesehatan'=>$faker->numerify('############'),
	            'nomor_bpjs_ketenagakerjaan'=>$faker->numerify('###########'),
	            'organisasi_id'=>$faker->randomElement([1,2,3])
        	];
        	array_push($data_karyawan, $data);
        }

        Karyawan::insert($data_karyawan);
    }
}
