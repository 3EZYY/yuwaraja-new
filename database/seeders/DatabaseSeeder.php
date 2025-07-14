<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $this->call([
            Kelompok_Seeder::class,
            Userdata_Seeder::class,
            Pengumuman_Seeder::class,
            Tugas_Seeder::class,
            Jadwal_Acara_Seeder::class,
        ]);
    }
}
