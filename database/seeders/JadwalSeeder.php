<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        DB::table('jadwals')->insert([
            [
                'id' => 13,
                'kelas_id' => 31,
                'mapel_id' => 148,
                'tahun_id' => 1,
                'pegawai_id' => 9,
                'hari_id' => 7,
                'jam' => '10:00',
                'created_at' => '2023-12-14 04:06:29',
                'updated_at' => '2023-12-25 06:48:20',
            ],
            [
                'id' => 14,
                'kelas_id' => 31,
                'mapel_id' => 149,
                'tahun_id' => 1,
                'pegawai_id' => 9,
                'hari_id' => 1,
                'jam' => '10:00',
                'created_at' => '2023-12-14 04:07:26',
                'updated_at' => '2023-12-14 04:07:26',
            ],
            [
                'id' => 16,
                'kelas_id' => 31,
                'mapel_id' => 154,
                'tahun_id' => 1,
                'pegawai_id' => 9,
                'hari_id' => 1,
                'jam' => '14:37',
                'created_at' => '2023-12-25 07:36:02',
                'updated_at' => '2023-12-25 07:36:02',
            ],
        ]);
    }
}