<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNikInSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('siswas', function (Blueprint $table) {
        $table->string('nik')->nullable()->after('id');
    });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('siswas', function (Blueprint $table) {
             $table->dropColumn('nik');
         });
    }
}
