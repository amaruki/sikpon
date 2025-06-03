<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    public function run()
    {
        DB::table('mapels')->insert([
            [
                'id' => 1,
                'uuid' => '6d1ccc81-77f0-42c3-a587-5ed7f57d67b4',
                'nama' => 'BTQ',
                'created_at' => '2023-12-13 01:30:06',
                'updated_at' => '2023-12-24 23:11:46',
            ],
            [
                'id' => 2,
                'uuid' => '94487960-b927-4908-8cd9-45a0282c5e87',
                'nama' => 'Fiqih',
                'created_at' => '2023-12-13 20:58:15',
                'updated_at' => '2023-12-24 23:11:57',
            ],
            [
                'id' => 3,
                'uuid' => '8648e448-4ed0-495d-abf8-e886b501baed',
                'nama' => 'Akhlak',
                'created_at' => '2023-12-24 23:12:06',
                'updated_at' => '2023-12-24 23:12:06',
            ],
            [
                'id' => 4,
                'uuid' => '811ad07a-41ef-4270-9ff2-eddc19b0c770',
                'nama' => 'Bahasa Arab',
                'created_at' => '2023-12-24 23:12:16',
                'updated_at' => '2023-12-24 23:12:16',
            ],
            [
                'id' => 5,
                'uuid' => 'f2dd0d2b-9c67-468b-a8fa-1a1c5e7ba33a',
                'nama' => 'Tarikh',
                'created_at' => '2023-12-24 23:12:26',
                'updated_at' => '2023-12-24 23:12:26',
            ],
            [
                'id' => 6,
                'uuid' => '351b30c1-937b-4854-ab20-7c5b36bf6276',
                'nama' => 'Akidah',
                'created_at' => '2023-12-24 23:12:34',
                'updated_at' => '2023-12-24 23:12:34',
            ],
        ]);
    }
}