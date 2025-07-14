<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kelompok_Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelompoks')->insert([
            [
                'id' => 1,
                'nama_kelompok' => 'Cluster Alpha',
                'code' => 'H4J6Y',
                'spv_id' => 1,
                'created_at' => '2025-07-12 18:23:38',
                'updated_at' => '2025-07-13 12:36:29',
            ],
            [
                'id' => 2,
                'nama_kelompok' => 'Cluster Beta',
                'code' => 'TSMVB',
                'spv_id' => 2,
                'created_at' => '2025-07-12 18:23:03',
                'updated_at' => '2025-07-13 12:36:29',
            ],
        ]);
    }
}
