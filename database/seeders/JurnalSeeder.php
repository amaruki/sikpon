<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JurnalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("jurnal")->insert([
            [
                "id"=>1,
                "kode_jurnal"=>'JRN-20250523-001',
                "tanggal"=>'2025-05-23',
                "guru_id"=>9,
                "mapel_id"=>148,
                "kelas_id"=>31,
                "materi_pokok"=>'123213',
                "kegiatan_pembelajaran"=>'asdsadsad',
                "evaluasi_pembelajaran"=>'qdasdsadsakjd',
                "siswa_hadir"=>'["10"]',
                "siswa_tidak_hadir"=>NULL,
                "jumlah_hadir"=>1,
                "jumlah_tidak_hadir"=>0,
                "catatan_khusus"=>NULL,
                "kendala_pembelajaran"=>NULL,
                "solusi_kendala"=>NULL,
                "status_jurnal"=>"draft",
                "pencapaian_target"=>"tidak_tercapai",
                "keterangan_pencapaian"=>NULL,
                "jam_mulai"=>"19:00",
                "jam_selesai"=>"20:00",
                "created_at"=>"2025-05-23 18:16:33",
                "updated_at"=>"2025-05-23 18:16:33",
            ],
        
        ]);
    }
}
