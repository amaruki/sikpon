<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jurnal')->unique();
            $table->date('tanggal');
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelases')->onDelete('cascade');
            $table->string('materi_pokok');
            $table->text('kegiatan_pembelajaran');
            $table->text('evaluasi_pembelajaran');
            $table->json('santri_hadir')->nullable(); // Array ID santri yang hadir
            $table->json('santri_tidak_hadir')->nullable(); // Array ID santri yang tidak hadir dengan keterangan
            $table->integer('jumlah_hadir')->default(0);
            $table->integer('jumlah_tidak_hadir')->default(0);
            $table->text('catatan_khusus')->nullable();
            $table->text('kendala_pembelajaran')->nullable();
            $table->text('solusi_kendala')->nullable();
            $table->enum('status_jurnal', ['draft', 'final'])->default('draft');
            $table->enum('pencapaian_target', ['tercapai', 'sebagian', 'tidak_tercapai'])->default('tercapai');
            $table->text('keterangan_pencapaian')->nullable();
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->timestamps();
            
            // Indexes untuk performa
            $table->index(['tanggal', 'guru_id']);
            $table->index(['mata_pelajaran_id', 'kelas_id']);
            $table->index('status_jurnal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnals');
    }
}
