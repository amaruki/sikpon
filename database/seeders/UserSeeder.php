<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'uuid' => '756e6a13-4e27-4525-a327-c5b4b60d1249',
                'role' => 'Dev',
                'name' => 'Admin',
                'username' => 'admin',
                'email' => null,
                'email_verified_at' => null,
                'password' => '$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',
                'pegawai_id' => null,
                'siswa_id' => null,
                'remember_token' => null,
                'created_at' => '2023-04-10 17:57:04',
                'updated_at' => '2023-04-10 17:57:04',
            ],
            [
                'id' => 17,
                'uuid' => 'd48b1964-afde-4a19-8192-8db7d555657b',
                'role' => 'Guru',
                'name' => null,
                'username' => 'ekopur',
                'email' => null,
                'email_verified_at' => null,
                'password' => '$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',
                'pegawai_id' => 9,
                'siswa_id' => null,
                'remember_token' => null,
                'created_at' => '2023-10-29 05:58:51',
                'updated_at' => '2023-10-30 00:25:18',
            ],
            [
                'id' => 18,
                'uuid' => '81da124a-3554-4115-b1f2-b6dd61146e8f',
                'role' => 'Siswa',
                'name' => null,
                'username' => 'bedul',
                'email' => null,
                'email_verified_at' => null,
                'password' => '$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',
                'pegawai_id' => null,
                'siswa_id' => 10,
                'remember_token' => null,
                'created_at' => '2023-10-29 20:06:33',
                'updated_at' => '2023-10-30 00:25:52',
            ],
            [
                'id' => 19,
                'uuid' => 'd24039b8-341d-48ef-ae30-9c421b1c1ef1',
                'role' => 'Guru',
                'name' => null,
                'username' => 'mini',
                'email' => null,
                'email_verified_at' => null,
                'password' => '$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',
                'pegawai_id' => 11,
                'siswa_id' => null,
                'remember_token' => null,
                'created_at' => '2023-11-16 18:34:46',
                'updated_at' => '2023-11-16 18:34:46',
            ],
        ]);
    }
}