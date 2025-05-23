<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariSeeder extends Seeder
{
    public function run()
    {
        DB::table('haris')->insert([
            [
                'id' => 1,
                'nama' => 'Senin',
                'created_at' => '2023-10-29 10:10:44',
                'updated_at' => '2023-10-29 10:10:44',
            ],
            [
                'id' => 2,
                'nama' => 'Selasa',
                'created_at' => '2023-10-29 10:10:51',
                'updated_at' => '2023-10-29 10:10:51',
            ],
            [
                'id' => 3,
                'nama' => 'Rabu',
                'created_at' => '2023-10-29 10:11:03',
                'updated_at' => '2023-10-29 10:11:03',
            ],
            [
                'id' => 4,
                'nama' => 'Kamis',
                'created_at' => '2023-10-29 10:11:13',
                'updated_at' => '2023-10-29 10:11:13',
            ],
            [
                'id' => 6,
                'nama' => 'Jumat',
                'created_at' => '2023-10-29 10:11:29',
                'updated_at' => '2023-10-29 10:11:29',
            ],
            [
                'id' => 7,
                'nama' => 'Sabtu',
                'created_at' => '2023-10-29 10:11:36',
                'updated_at' => '2023-10-29 10:11:36',
            ],
        ]);
    }
}