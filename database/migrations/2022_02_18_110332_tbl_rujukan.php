<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblRujukan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          if(!Schema::hasTable('rujukan')) {
            Schema::create('rujukan', function (Blueprint $table) {
                $table->bigIncrements('id');
                    $table->text('kartu_berobat');
                    $table->text('nama')->nullable();
                    $table->text('umur')->nullable();
                    $table->text('pekerjaan')->nullable();
                    $table->text('alamat')->nullable();
                    $table->text('rs_tujuan')->nullable();
                    $table->text('diagnosa')->nullable();
                    $table->dateTime('tgl_surat')->nullable();

          
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
       Schema::dropIfExists('rujukan');
    }
}
