// create_rapots_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapotsTable extends Migration
{
    public function up()
    {
        Schema::create('rapots', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_id');
            
            $table->enum('semester', ['ganjil', 'genap']);
            $table->integer('jumlah_sakit')->default(0);
            $table->integer('jumlah_izin')->default(0);
            $table->integer('jumlah_alpa')->default(0);
            $table->text('catatan_wali_kelas')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('kelas_id')->references('id')->on('kelases');
            $table->foreign('tahun_id')->references('id')->on('tahuns');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapots');
    }
}
