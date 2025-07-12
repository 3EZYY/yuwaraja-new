<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu apakah user admin sudah ada atau belum
        $adminUser = User::where('email', 'admin@yuwaraja.com')->first();

        // Jika belum ada, buat baru
        if (!$adminUser) {
            User::create([
                'name' => 'Admin Yuwaraja',
                'nim' => '000000000', // NIM khusus untuk admin
                'username' => 'admin',
                'email' => 'admin@yuwaraja.com',
                'program_studi' => 'Sistem Informasi',
                'angkatan' => '2023',
                'nomor_telepon' => '081234567890',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'password' => Hash::make('alamak24'), // Ganti 'password' dengan password yang Anda inginkan
                'role' => 'admin',
                'email_verified_at' => now(), // Langsung terverifikasi
            ]);

            echo "✅ Admin user berhasil dibuat!\n";
        } else {
            echo "ℹ️ Admin user sudah ada, tidak perlu dibuat lagi.\n";
        }
    }
}
