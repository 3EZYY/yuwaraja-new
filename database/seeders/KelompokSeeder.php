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
        // Buat SPV users
        $spv1 = User::create([
            'name' => 'SPV Alpha',
            'nim' => 'SPV001',
            'username' => 'spv_alpha',
            'email' => 'spv_alpha@example.com',
            'password' => Hash::make('password'),
            'program_studi' => 'Teknik Informatika',
            'angkatan' => '2021',
            'role' => 'spv'
        ]);

        $spv2 = User::create([
            'name' => 'SPV Beta',
            'nim' => 'SPV002',
            'username' => 'spv_beta',
            'email' => 'spv_beta@example.com',
            'password' => Hash::make('password'),
            'program_studi' => 'Teknik Informatika',
            'angkatan' => '2021',
            'role' => 'spv'
        ]);

        // Buat kelompok
        $kelompok1 = Kelompok::create([
            'nama_kelompok' => 'Kelompok Alpha',
            'spv_id' => $spv1->id
        ]);

        $kelompok2 = Kelompok::create([
            'nama_kelompok' => 'Kelompok Beta',
            'spv_id' => $spv2->id
        ]);

        // Buat mahasiswa
        User::create([
            'name' => 'Mahasiswa 1',
            'nim' => 'MHS001',
            'username' => 'mahasiswa1',
            'email' => 'mhs1@example.com',
            'password' => Hash::make('password'),
            'program_studi' => 'Teknik Informatika',
            'angkatan' => '2022',
            'role' => 'mahasiswa',
            'kelompok_id' => $kelompok1->id
        ]);

        User::create([
            'name' => 'Mahasiswa 2',
            'nim' => 'MHS002',
            'username' => 'mahasiswa2',
            'email' => 'mhs2@example.com',
            'password' => Hash::make('password'),
            'program_studi' => 'Teknik Informatika',
            'angkatan' => '2022',
            'role' => 'mahasiswa',
            'kelompok_id' => $kelompok2->id
        ]);
    }
}
