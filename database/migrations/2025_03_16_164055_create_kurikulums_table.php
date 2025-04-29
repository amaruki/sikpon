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
            $table->unsignedBigInteger('kelas_id')->constrained('kelases')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('mapel_id')->constrained('mapels')->onDelete('cascade')->nullable();
            $table->longText('standar_kompetensi')->nullable();
            $table->longText('kompetensi_dasar')->nullable();        
            $table->string('jam_pelajaran', 100)->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};
