<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblRekam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('rekam')) {
            Schema::create('rekam', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('id_poli');
                $table->text('id_pasien');
                $table->text('username')->nullable();
                $table->dateTime('tanggal')->nullable();
                $table->text('diagnosa')->nullable();
                $table->text('pengobatan')->nullable();
                $table->text('jns_pengobatan')->nullable();
                $table->text('petugas')->nullable();
                $table->text('terapi')->nullable();
                $table->text('nama_pembayar')->nullable();
                $table->text('uang_diterima')->nullable();
                $table->dateTime('tanggal_keluar')->nullable();

        
            });
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('rekam');
    }
}
