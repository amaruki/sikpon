<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hari_id')->constrained('haris')->onDelete('restrict');
            $table->foreignId('kelas_id')->constrained('kelases')->onDelete('restrict');
            $table->foreignId('mapel_id')->constrained('mapels')->onDelete('restrict');
            $table->string('jam');
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('restrict');
            $table->foreignId('tahun_id')->constrained('tahuns')->onDelete('restrict');
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
        Schema::dropIfExists('jadwals');
    }
}
