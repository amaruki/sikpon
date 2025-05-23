<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunSeeder extends Seeder
{
    public function run()
    {
        DB::table('tahuns')->insert([
            [
                'id' => 1,
                'nama' => '2023',
                'created_at' => '2023-10-27 07:43:30',
                'updated_at' => '2023-10-27 07:50:23',
            ],
            [
                'id' => 2,
                'nama' => '2024',
                'created_at' => '2023-10-30 07:40:37',
                'updated_at' => '2023-10-30 07:40:37',
            ],
        ]);
    }
}
