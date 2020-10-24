<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawan');
            $table->date('tanggal');
            $table->timestamp('masuk');
            $table->timestamp('pulang')->nullable();
            $table->boolean('telat')->default(false);
            $table->enum('status',['masuk','belum masuk','pulang','alpha','telat'])->default('belum masuk');
            $table->primary(['karyawan_id','tanggal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensi');
    }
}
