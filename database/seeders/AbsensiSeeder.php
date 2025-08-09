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
        $absensiData = [
            [
                'judul' => 'Upacara Pembukaan PKKMB UB 2025',
                'deskripsi' => 'Upacara pembukaan Program Kreativitas Kesiswaan Mahasiswa Baru Universitas Brawijaya 2025',
                'tanggal' => Carbon::today()->toDateString(),
                'jam_mulai' => '07:00',
                'jam_selesai' => '09:00',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pelatihan Kepemimpinan Mahasiswa',
                'deskripsi' => 'Pelatihan untuk mengembangkan jiwa kepemimpinan mahasiswa baru',
                'tanggal' => Carbon::today()->addDay()->toDateString(),
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Seminar Akademik dan Kemahasiswaan',
                'deskripsi' => 'Seminar mengenai kehidupan akademik dan organisasi kemahasiswaan di UB',
                'tanggal' => Carbon::today()->addDays(2)->toDateString(),
                'jam_mulai' => '13:00',
                'jam_selesai' => '16:00',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Workshop Kreativitas dan Inovasi',
                'deskripsi' => 'Workshop untuk mengembangkan kreativitas dan inovasi mahasiswa',
                'tanggal' => Carbon::today()->addDays(3)->toDateString(),
                'jam_mulai' => '09:00',
                'jam_selesai' => '15:00',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Penutupan PKKMB UB 2025',
                'deskripsi' => 'Acara penutupan Program Kreativitas Kesiswaan Mahasiswa Baru UB 2025',
                'tanggal' => Carbon::today()->addDays(4)->toDateString(),
                'jam_mulai' => '08:00',
                'jam_selesai' => '11:00',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($absensiData as $data) {
            Absensi::create($data);
        }
    }
}
