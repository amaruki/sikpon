<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        DB::table('pegawais')->insert([
            [
                'id' => 8,
                'uuid' => '1d79c7c8-e479-44b6-89bb-1a8a8705b051',
                'nama' => 'DELNEDI ZISWAN, M.Pd',
                'nip' => '19701223 200701 1 007',
                'jabatan' => 'Kepsek',
                'created_at' => '2023-05-10 18:52:50',
                'updated_at' => '2023-05-21 00:24:01',
            ],
            [
                'id' => 9,
                'uuid' => '27613d0d-0c9a-4db8-a199-3690408f2710',
                'nama' => 'EKO PURWADI, S.Si',
                'nip' => '19810208 200803 1 001',
                'jabatan' => 'Guru',
                'created_at' => '2023-05-21 00:24:46',
                'updated_at' => '2023-05-21 00:24:46',
            ],
            [
                'id' => 10,
                'uuid' => '9023262e-d638-4422-9872-fef1b3e42c6c',
                'nama' => 'EKO SAPUTRO, S.Pd',
                'nip' => '19760107 201001 1 004',
                'jabatan' => 'Guru',
                'created_at' => '2023-05-21 00:26:00',
                'updated_at' => '2023-05-21 00:26:00',
            ],
            [
                'id' => 11,
                'uuid' => '061698d0-6243-477d-a38e-8b574b953618',
                'nama' => 'SUMINI, S.Ag',
                'nip' => '197101052007012006',
                'jabatan' => 'Guru',
                'created_at' => '2023-05-21 00:26:30',
                'updated_at' => '2023-05-21 00:26:30',
            ],
            [
                'id' => 12,
                'uuid' => '18584f91-faff-4f51-b50b-8126c3dd51c8',
                'nama' => 'SU\'IB, S.Ag',
                'nip' => '197310042008011001',
                'jabatan' => 'Guru',
                'created_at' => '2023-05-21 00:27:03',
                'updated_at' => '2023-09-28 01:31:38',
            ],
            [
                'id' => 58,
                'uuid' => 'fe8885c0-ad02-45f9-8faa-6716427ef69a',
                'nama' => 'MARYATI, S.IP',
                'nip' => '-',
                'jabatan' => 'Staff',
                'created_at' => '2023-05-21 00:59:56',
                'updated_at' => '2023-05-21 00:59:56',
            ],
            [
                'id' => 59,
                'uuid' => '48adfcbc-3595-4df8-87e5-ac3e978020a2',
                'nama' => 'HARIADI',
                'nip' => '-',
                'jabatan' => 'Staff',
                'created_at' => '2023-05-21 01:00:27',
                'updated_at' => '2023-05-21 01:00:27',
            ],
            [
                'id' => 60,
                'uuid' => '84b8eef6-5134-4e9b-b093-47987f62136b',
                'nama' => 'NUR CAHYANTO',
                'nip' => '-',
                'jabatan' => 'Staff',
                'created_at' => '2023-05-21 01:00:54',
                'updated_at' => '2023-05-21 01:00:54',
            ],
            [
                'id' => 61,
                'uuid' => 'b747ad81-dc36-45e7-b3a4-e8d70bc5b507',
                'nama' => 'M. DEFRI GUSTIAN',
                'nip' => '-',
                'jabatan' => 'Staff',
                'created_at' => '2023-05-21 01:01:14',
                'updated_at' => '2023-05-21 01:01:14',
            ],
        ]);
    }
}
