<?php

use Illuminate\Support\Facades\Route;

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
	Route::get('/karyawan/{jenis}','KaryawanController@index');
	Route::post('/karyawan','KaryawanController@create');
	Route::patch('/karyawan','KaryawanController@edit');
	Route::post('/karyawan/update_status','KaryawanController@updateStatus');
	Route::put('/karyawan','KaryawanController@importDataKaryawan');
	Route::post('/karyawan/non-aktifkan','KaryawanController@nonAktifkanBanyak');

	Route::get('/presensi','PresensiController@index');
	

	Route::get('/struktur_organisasi','OrganisasiController@index');
	

	Route::get('/user','UserController@index');
	

	Route::get('/pengaturan','PengaturanController@index');
});

Route::get('/logout','GeneralController@logout');
Route::get('/tes','KaryawanController@tesExport');