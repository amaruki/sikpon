<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kurikulums', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('kelas_id')->constrained('kelases')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');
            $table->longText('standar_kompetensi');
            $table->longText('kompetensi_dasar');        
            $table->string('jam_pelajaran', 100);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};
