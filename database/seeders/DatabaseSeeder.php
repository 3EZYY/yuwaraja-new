<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil semua seeder di sini
        $this->call([
            Userdata_Seeder::class,
            Kelompok_Seeder::class,
            Pengumuman_Seeder::class,
            Tugas_Seeder::class,
            Jadwal_Acara_Seeder::class,
        ]);
    }
}
