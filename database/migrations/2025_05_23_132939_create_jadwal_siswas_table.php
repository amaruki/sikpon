<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_siswas', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_id');
            $table->integer('jadwal_id');
            $table->integer('siswa_id');
            $table->integer('tahun_id');
            $table->integer('kelas_id');
            $table->integer('mapel_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_siswas');
    }
}
