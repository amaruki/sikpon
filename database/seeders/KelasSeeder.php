<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        DB::table('kelases')->insert([
            [
                'id' => 31,
                'kelas' => '1',
                'nama' => 'A',
                'pegawai_id' => 11,
                'tahun_id' => 1,
                'created_at' => '2023-12-13 08:29:54',
                'updated_at' => '2023-12-13 08:29:54',
            ],
        ]);
    }
}