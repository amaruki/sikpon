<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('nama')->nullable();
            $table->string('nisn')->nullable();
            $table->string('jk')->nullable();
            $table->string('tempat')->nullable();
            $table->string('ttl')->nullable();
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->string('kerja_ayah')->nullable();
            $table->string('kerja_ibu')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kec')->nullable();
            $table->string('kel')->nullable();
            $table->string('kelas_id')->nullable();
            $table->string('hp')->nullable();
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
        Schema::dropIfExists('siswas');
    }
}
