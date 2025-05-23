<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PegawaiSeeder::class,
            TahunSeeder::class,
            HariSeeder::class,
            MapelSeeder::class,
            SiswaSeeder::class,
            KelasSeeder::class,
            InformasiSeeder::class,
            JadwalSeeder::class,
            JadwalSiswaSeeder::class,
            
        ]);
    }
}
