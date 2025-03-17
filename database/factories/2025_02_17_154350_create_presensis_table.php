// create_presensis_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('jadwal_siswa_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('tahun_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('mapel_id');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpa']);
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('jadwal_siswa_id')->references('id')->on('jadwal_siswas');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
            $table->foreign('jadwal_id')->references('id')->on('jadwals');
            $table->foreign('tahun_id')->references('id')->on('tahuns');
            $table->foreign('kelas_id')->references('id')->on('kelases');
            $table->foreign('mapel_id')->references('id')->on('mapels');
        });
    }

    public function down()
    {
        Schema::dropIfExists('presensis');
    }
}