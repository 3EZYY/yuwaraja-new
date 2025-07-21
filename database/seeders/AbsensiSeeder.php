<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample attendance sessions
        Absensi::create([
            'judul' => 'Absensi Pagi - Orientasi Mahasiswa Baru',
            'deskripsi' => 'Absensi untuk kegiatan orientasi mahasiswa baru hari pertama',
            'jam_mulai' => Carbon::today()->setTime(8, 0, 0),
            'jam_selesai' => Carbon::today()->setTime(10, 0, 0),
            'is_active' => true,
        ]);

        Absensi::create([
            'judul' => 'Absensi Siang - Workshop Teknologi',
            'deskripsi' => 'Absensi untuk workshop teknologi dan inovasi',
            'jam_mulai' => Carbon::today()->setTime(13, 0, 0),
            'jam_selesai' => Carbon::today()->setTime(15, 0, 0),
            'is_active' => true,
        ]);

        Absensi::create([
            'judul' => 'Absensi Kemarin - Seminar Karir',
            'deskripsi' => 'Absensi untuk seminar karir dan pengembangan diri',
            'jam_mulai' => Carbon::yesterday()->setTime(9, 0, 0),
            'jam_selesai' => Carbon::yesterday()->setTime(11, 0, 0),
            'is_active' => false,
        ]);
    }
}