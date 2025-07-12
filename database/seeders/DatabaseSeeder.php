<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder admin Anda di sini
        $this->call([
            AdminUserSeeder::class,
            KelompokSeeder::class
        ]);

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
            'angkatan' => '2023',
            'nomor_telepon' => '081234567892',
            'tanggal_lahir' => '2005-03-22',
            'jenis_kelamin' => 'Laki-laki',
            'password' => Hash::make('rafifnabiha'),
            'role' => 'Mahasiswa',
            'cluster' => 'Kelompok Gamma',
            'email_verified_at' => now(),
        ]);
    }
}
