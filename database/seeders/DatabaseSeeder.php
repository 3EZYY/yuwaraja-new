<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            Userdata_Seeder::class,      // Seed users first
            Kelompok_Seeder::class,      // Then kelompoks
            Pengumuman_Seeder::class,
            Tugas_Seeder::class,
            Jadwal_Acara_Seeder::class,
            SurveySeeder::class,         // Survey data
            AbsensiSeeder::class,        // Absensi data
        ]);
    }
}
