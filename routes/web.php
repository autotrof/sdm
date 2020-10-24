<?php

use Illuminate\Support\Facades\Route;
use App\Organisasi;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'guest'],function(){
	Route::get('/login','GeneralController@loginPage');
	Route::post('/login','GeneralController@cekLogin');
});

Route::group(['middleware'=>'auth'],function(){
	Route::get('/',function(){
		return redirect('/karyawan/aktif');
	});
	
	Route::any('/karyawan/data/{jenis}','KaryawanController@data');
	Route::get('/karyawan/export','KaryawanController@exportData');
	Route::post('/karyawan/export_terpilih','KaryawanController@exportDataTerpilih');
	Route::get('/karyawan/{jenis}','KaryawanController@index');
	Route::post('/karyawan','KaryawanController@create');
	Route::patch('/karyawan','KaryawanController@edit');
	Route::post('/karyawan/update_status','KaryawanController@updateStatus');
	Route::put('/karyawan','KaryawanController@importDataKaryawan');
	Route::post('/karyawan/non-aktifkan','KaryawanController@nonAktifkanBanyak');
	Route::post('/karyawan/aktifkan','KaryawanController@aktifkanBanyak');
	Route::get('/karyawan/download_pdf/{id}','KaryawanController@downloadPdf');
	Route::get('/karyawan/foto/{id}','KaryawanController@getFoto');

	Route::any('/presensi/data','PresensiController@data');
	Route::put('/presensi','PresensiController@importDataPresensi');
	Route::resource('/presensi','PresensiController');
	
	Route::any('/struktur_organisasi/data','OrganisasiController@data');
	Route::post('/struktur_organisasi/edit','OrganisasiController@edit');
	Route::get('/struktur_organisasi/delete/{id}','OrganisasiController@hapus');
	Route::any('/struktur_organisasi/detail/{id}','OrganisasiController@showOne');
	Route::resource('/struktur_organisasi','OrganisasiController');
	
	

	Route::any('/user/data','UserController@data');
	Route::post('/user/edit','UserController@edit');
	Route::get('/user/delete/{id}','UserController@hapus');
	Route::post('/user/hapus_beberapa','UserController@hapusBeberapa');
	Route::resource('/user','UserController');
	

	Route::get('/pengaturan','PengaturanController@index');
});

Route::get('/logout','GeneralController@logout');