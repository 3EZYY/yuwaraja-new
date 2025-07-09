<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Yuwaraja',
            'username' => 'admin',
            'email' => 'admin@yuwaraja.com',
            'program_studi' => 'Sistem Informasi',
            'angkatan' => '2023',
            'nomor_telepon' => '081234567890',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang Anda inginkan
            'role' => 'admin',
            'email_verified_at' => now(), // Langsung terverifikasi
        ]);
    }
}
