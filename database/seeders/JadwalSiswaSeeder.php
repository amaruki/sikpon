<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('jadwal_siswas')->insert([
            [
                'id' => 18,
                'pegawai_id' => 9,
                'jadwal_id' => 13,
                'siswa_id' => 10,
                'tahun_id' => 1,
                'kelas_id' => 31,
                'mapel_id' => 148,
                'created_at' => '2023-12-14 04:06:35',
                'updated_at' => '2023-12-14 04:06:35',
            ],
            [
                'id' => 19,
                'pegawai_id' => 9,
                'jadwal_id' => 14,
                'siswa_id' => 10,
                'tahun_id' => 1,
                'kelas_id' => 31,
                'mapel_id' => 149,
                'created_at' => '2023-12-14 04:07:34',
                'updated_at' => '2023-12-14 04:07:34',
            ],
            [
                'id' => 20,
                'pegawai_id' => 9,
                'jadwal_id' => 13,
                'siswa_id' => 11,
                'tahun_id' => 1,
                'kelas_id' => 31,
                'mapel_id' => 148,
                'created_at' => '2023-12-14 05:11:27',
                'updated_at' => '2023-12-14 05:11:27',
            ],
            [
                'id' => 21,
                'pegawai_id' => 9,
                'jadwal_id' => 16,
                'siswa_id' => 10,
                'tahun_id' => 1,
                'kelas_id' => 31,
                'mapel_id' => 154,
                'created_at' => '2023-12-25 07:36:14',
                'updated_at' => '2023-12-25 07:36:14',
            ],
            [
                'id' => 22,
                'pegawai_id' => 9,
                'jadwal_id' => 16,
                'siswa_id' => 13,
                'tahun_id' => 1,
                'kelas_id' => 31,
                'mapel_id' => 154,
                'created_at' => '2023-12-25 07:36:18',
                'updated_at' => '2023-12-25 07:36:18',
            ],
            [
                'id' => 23,
                'pegawai_id' => 9,
                'jadwal_id' => 14,
                'siswa_id' => 11,
                'tahun_id' => 1,
                'kelas_id' => 31,
                'mapel_id' => 149,
                'created_at' => '2023-12-27 08:11:02',
                'updated_at' => '2023-12-27 08:11:02',
            ],
            [
                'id' => 24,
                'pegawai_id' => 9,
                'jadwal_id' => 13,
                'siswa_id' => 13,
                'tahun_id' => 1,
                'kelas_id' => 31,
                'mapel_id' => 148,
                'created_at' => '2023-12-27 08:32:58',
                'updated_at' => '2023-12-27 08:32:58',
            ],
        ]);
    }
}