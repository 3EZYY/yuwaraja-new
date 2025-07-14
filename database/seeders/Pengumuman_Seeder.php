<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pengumuman_Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengumuman')->insert([
            [
                'id' => 1,
                'judul' => 'PPKMB YUWARARAJA DAY 1',
                'konten' => 'intinyaaa kalian harrus stay tune yaaaa!',
                'tipe' => 'umum',
                'is_published' => 1,
                'published_at' => '2025-07-13 00:29:37',
                'created_at' => '2025-07-12 17:29:42',
                'updated_at' => '2025-07-12 23:03:48',
            ],
            [
                'id' => 2,
                'judul' => 'PPKMB YUWARARAJA DAY 2',
                'konten' => 'intinyaaa kalian harrus stay tune yaaaa!',
                'tipe' => 'umum',
                'is_published' => 1,
                'published_at' => '2025-07-14 07:40:27',
                'created_at' => '2025-07-12 17:40:40',
                'updated_at' => '2025-07-12 23:03:55',
            ],
        ]);
    }
}
