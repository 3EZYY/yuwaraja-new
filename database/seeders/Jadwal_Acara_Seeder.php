<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Jadwal_Acara_Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_acara')->insert([
            [
                'id' => 1,
                'nama_acara' => 'PPKMB Hari 1',
                'deskripsi' => 'Pembukaan dan pengenalan kampus',
                'tanggal_mulai' => '2025-07-13 08:00:00',
                'tanggal_selesai' => '2025-07-13 12:00:00',
                'lokasi' => 'Aula Utama',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_acara' => 'PPKMB Hari 2',
                'deskripsi' => 'Materi dan games',
                'tanggal_mulai' => '2025-07-14 08:00:00',
                'tanggal_selesai' => '2025-07-14 12:00:00',
                'lokasi' => 'Aula Utama',
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
