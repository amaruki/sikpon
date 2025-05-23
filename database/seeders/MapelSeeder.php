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
                'id' => 148,
                'uuid' => '6d1ccc81-77f0-42c3-a587-5ed7f57d67b4',
                'nama' => 'Bahasa Indonesia',
                'created_at' => '2023-12-13 01:30:06',
                'updated_at' => '2023-12-24 23:11:46',
            ],
            [
                'id' => 149,
                'uuid' => '94487960-b927-4908-8cd9-45a0282c5e87',
                'nama' => 'Matematika',
                'created_at' => '2023-12-13 20:58:15',
                'updated_at' => '2023-12-24 23:11:57',
            ],
            [
                'id' => 150,
                'uuid' => '8648e448-4ed0-495d-abf8-e886b501baed',
                'nama' => 'Seni',
                'created_at' => '2023-12-24 23:12:06',
                'updated_at' => '2023-12-24 23:12:06',
            ],
            [
                'id' => 151,
                'uuid' => '811ad07a-41ef-4270-9ff2-eddc19b0c770',
                'nama' => 'Pendidikan Agama',
                'created_at' => '2023-12-24 23:12:16',
                'updated_at' => '2023-12-24 23:12:16',
            ],
            [
                'id' => 152,
                'uuid' => 'f2dd0d2b-9c67-468b-a8fa-1a1c5e7ba33a',
                'nama' => 'Pendidikan Jasmani',
                'created_at' => '2023-12-24 23:12:26',
                'updated_at' => '2023-12-24 23:12:26',
            ],
            [
                'id' => 153,
                'uuid' => '351b30c1-937b-4854-ab20-7c5b36bf6276',
                'nama' => 'Bahasa Inggris',
                'created_at' => '2023-12-24 23:12:34',
                'updated_at' => '2023-12-24 23:12:34',
            ],
            [
                'id' => 154,
                'uuid' => '7934ea49-dc54-4df7-b15d-55932caf68be',
                'nama' => 'Baca Tulis Al-Qur\'an',
                'created_at' => '2023-12-24 23:13:03',
                'updated_at' => '2023-12-24 23:13:03',
            ],
            [
                'id' => 155,
                'uuid' => '6ab39d67-56d5-4684-97de-6adfd2d6c611',
                'nama' => 'IPAS',
                'created_at' => '2023-12-24 23:13:08',
                'updated_at' => '2023-12-24 23:13:08',
            ],
        ]);
    }
}