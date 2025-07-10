<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelompok;
use Illuminate\Support\Facades\Hash;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat SPV users dengan firstOrCreate untuk menghindari duplikasi
        $spv1 = User::firstOrCreate(
            ['username' => 'spv_alpha'],
            [
                'name' => 'SPV Alpha',
                'nim' => 'SPV001',
                'email' => 'spv_alpha@example.com',
                'password' => Hash::make('password'),
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2021',
                'nomor_telepon' => '081234567890',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'role' => 'spv'
            ]
        );

        $spv2 = User::firstOrCreate(
            ['username' => 'spv_beta'],
            [
                'name' => 'SPV Beta',
                'nim' => 'SPV002',
                'email' => 'spv_beta@example.com',
                'password' => Hash::make('password'),
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2021',
                'nomor_telepon' => '081234567891',
                'tanggal_lahir' => '1995-02-01',
                'jenis_kelamin' => 'Perempuan',
                'role' => 'spv'
            ]
        );

        // Buat kelompok dengan firstOrCreate
        $kelompok1 = Kelompok::firstOrCreate(
            ['nama_kelompok' => 'Kelompok Alpha'],
            ['spv_id' => $spv1->id]
        );

        $kelompok2 = Kelompok::firstOrCreate(
            ['nama_kelompok' => 'Kelompok Beta'],
            ['spv_id' => $spv2->id]
        );

        // Buat mahasiswa dengan firstOrCreate
        User::firstOrCreate(
            ['username' => 'mahasiswa1'],
            [
                'name' => 'Mahasiswa 1',
                'nim' => 'MHS001',
                'email' => 'mhs1@example.com',
                'password' => Hash::make('password'),
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2022',
                'nomor_telepon' => '081234567892',
                'tanggal_lahir' => '2000-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'role' => 'mahasiswa',
                'kelompok_id' => $kelompok1->id
            ]
        );

        User::firstOrCreate(
            ['username' => 'mahasiswa2'],
            [
                'name' => 'Mahasiswa 2',
                'nim' => 'MHS002',
                'email' => 'mhs2@example.com',
                'password' => Hash::make('password'),
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2022',
                'nomor_telepon' => '081234567893',
                'tanggal_lahir' => '2000-02-01',
                'jenis_kelamin' => 'Perempuan',
                'role' => 'mahasiswa',
                'kelompok_id' => $kelompok2->id
            ]
        );
    }
}
