<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSeeder extends Seeder
{
    public function run()
    {
        DB::table('informases')->insert([
            [
                'id' => 1,
                'foto' => '1698652549_Screenshot_1.png',
                'isi' => 'ini nah isi',
                'created_at' => '2023-10-30 07:55:49',
                'updated_at' => '2023-10-30 07:55:49',
            ],
            [
                'id' => 2,
                'foto' => '1698655160_WhatsApp Image 2023-10-26 at 10.53.41 (1).jpeg',
                'isi' => 'nah he lorem',
                'created_at' => '2023-10-30 08:39:20',
                'updated_at' => '2023-10-30 08:39:20',
            ],
        ]);
    }
}