<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->string('nomor_ktp',16)->nullable();
            $table->string('nik',50)->nullable(false)->unique();
            $table->string('telp',20)->nullable();
            $table->string('email',100)->nullable();
            $table->string('detail_alamat')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status',['aktif','non aktif'])->default('aktif');
            $table->string('nomor_bpjs_kesehatan',20)->nullable();
            $table->string('nomor_bpjs_ketenagakerjaan',20)->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}
