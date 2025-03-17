// create_rapot_details_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapotDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('rapot_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rapot_id');
            $table->unsignedBigInteger('mapel_id');
            $table->decimal('nilai_pengetahuan', 5, 2)->nullable();
            $table->decimal('nilai_keterampilan', 5, 2)->nullable();
            $table->text('deskripsi_pengetahuan')->nullable();
            $table->text('deskripsi_keterampilan')->nullable();
            $table->timestamps();

            $table->foreign('rapot_id')->references('id')->on('rapots');
            $table->foreign('mapel_id')->references('id')->on('mapels');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapot_details');
    }
}