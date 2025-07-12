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

        // Tambahan user Hanin Betawi
        User::updateOrCreate([
            'email' => 'haninbetawi@gmail.com',
        ], [
            'name' => 'Hanin Betawi',
            'nim' => '223140707111092',
            'username' => 'hanin',
            'program_studi' => 'D4 Manajemen Perhotelan',
            'angkatan' => '2023',
            'nomor_telepon' => '081234567890',
            'tanggal_lahir' => '2003-07-15',
            'jenis_kelamin' => 'Laki-laki',
            'password' => Hash::make('haninbetawi'),
            'role' => 'SPV',
            'cluster' => 'Kelompok Alpha',
            'email_verified_at' => now(),
        ]);

        // Tambahan user Wawa Ponorogo
        User::updateOrCreate([
            'email' => 'wawaponorogo@gmail.com',
        ], [
            'name' => 'Wawa Ponorogo',
            'nim' => '233140707111087',
            'username' => 'wawa',
            'program_studi' => 'D3 Administrasi Bisnis',
            'angkatan' => '2023',
            'nomor_telepon' => '081234567891',
            'tanggal_lahir' => '2004-02-18',
            'jenis_kelamin' => 'Perempuan',
            'password' => Hash::make('wawaponorogo'),
            'role' => 'SPV',
            'cluster' => 'Kelompok Beta',
            'email_verified_at' => now(),
        ]);

        // Tambahan user Mahasiswa Rafif Nabiha
        User::updateOrCreate([
            'email' => 'rafifnabiha24@gmail.com',
        ], [
            'name' => 'Rafif Nabiha',
            'nim' => '253140707111056',
            'username' => 'rafif',
            'program_studi' => 'D3 Keuangan dan Perbankan',
            'angkatan' => '2025',
            'nomor_telepon' => '081234567892',
            'tanggal_lahir' => '2007-06-13',
            'jenis_kelamin' => 'Laki-laki',
            'password' => Hash::make('alamak24'),
            'role' => 'Mahasiswa',
            'cluster' => 'Kelompok Alpha',
            'email_verified_at' => now(),
        ]);

        // Tambahan user Mahasiswa Sabil Bandung
        User::updateOrCreate([
            'email' => 'sblhh.m@gmail.com',
        ], [
            'name' => 'Sabil Bandung',
            'nim' => '243140707111099',
            'username' => 'sabil',
            'program_studi' => 'D4 Desain Grafis',
            'angkatan' => '2024',
            'nomor_telepon' => '08123456232',
            'tanggal_lahir' => '2000-02-01',
            'jenis_kelamin' => 'Perempuan',
            'password' => Hash::make('sabil22'),
            'role' => 'Mahasiswa',
            'cluster' => 'Kelompok Beta',
            'email_verified_at' => now(),
        ]);
    }
}
