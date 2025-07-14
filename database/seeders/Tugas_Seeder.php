<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tugas_Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('tugas')->insert([
            [
                'id' => 1,
                'judul' => 'Menulis Lagu Laksamana GARP',
                'deskripsi' => 'lagu jangan lupa format nya',
                'deadline' => '2025-07-16',
                'tipe' => 'individual',
                'is_active' => 1,
                'created_at' => '2025-07-12 18:25:59',
                'updated_at' => '2025-07-12 18:25:59',
            ],
            [
                'id' => 2,
                'judul' => 'Rangkuman',
                'deskripsi' => 'jangan lupa di rangkum yaaa',
                'deadline' => '2025-07-15',
                'tipe' => 'individual',
                'is_active' => 0,
                'created_at' => '2025-07-12 18:26:25',
                'updated_at' => '2025-07-12 18:26:25',
            ],
        ]);
    }
}
