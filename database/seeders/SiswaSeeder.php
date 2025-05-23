<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('siswas')->insert([
            [
                'id' => 10,
                'uuid' => '4d14f0f5-fdea-4b80-91ea-852bbf2023c0',
                'nama' => 'Bedul',
                'jk' => 'Laki-Laki',
                'tempat' => 'Jakarta',
                'ttl' => '2023-10-27',
                'alamat' => 'lambur 5',
                'nis' => '11123235499',
                'hp' => '085215156165456',
                'created_at' => '2023-10-27 00:09:40',
                'updated_at' => '2023-10-27 00:11:01',
            ],
            [
                'id' => 11,
                'uuid' => 'e4e3cc8c-cbca-4f49-af1a-a18d0ef69364',
                'nama' => 'Samsul',
                'jk' => 'Laki-Laki',
                'tempat' => 'Jambi',
                'ttl' => '1999-01-08',
                'alamat' => 'Pondok',
                'nis' => '9789078967',
                'hp' => '0811565464',
                'created_at' => '2023-10-29 06:00:07',
                'updated_at' => '2023-10-29 06:00:07',
            ],
            [
                'id' => 12,
                'uuid' => 'e4e3cc8c-cbca-4f49-af1a-a18d0ef69364',
                'nama' => 'Sugiharto',
                'jk' => 'Laki-Laki',
                'tempat' => 'Jambi',
                'ttl' => '1999-01-08',
                'alamat' => 'Pondok',
                'nis' => '9789078967',
                'hp' => '0811565464',
                'created_at' => '2023-10-29 06:00:07',
                'updated_at' => '2023-10-29 06:00:07',
            ],
            [
                'id' => 13,
                'uuid' => 'e4e3cc8c-cbca-4f49-af1a-a18d0ef69364',
                'nama' => 'Tukiyem',
                'jk' => 'Laki-Laki',
                'tempat' => 'Jambi',
                'ttl' => '1999-01-08',
                'alamat' => 'Pondok',
                'nis' => '9789078967',
                'hp' => '0811565464',
                'created_at' => '2023-10-29 06:00:07',
                'updated_at' => '2023-10-29 06:00:07',
            ],
            [
                'id' => 14,
                'uuid' => 'e4e3cc8c-cbca-4f49-af1a-a18d0ef69364',
                'nama' => 'Brandon',
                'jk' => 'Laki-Laki',
                'tempat' => 'Jambi',
                'ttl' => '1999-01-08',
                'alamat' => 'Pondok',
                'nis' => '9789078967',
                'hp' => '0811565464',
                'created_at' => '2023-10-29 06:00:07',
                'updated_at' => '2023-10-29 06:00:07',
            ],
        ]);
    }
}