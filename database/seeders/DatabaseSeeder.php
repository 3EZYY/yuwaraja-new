<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder admin Anda di sini
        $this->call([
            AdminUserSeeder::class,
            KelompokSeeder::class,
        ]);

        // Anda bisa menambahkan seeder lain di sini nanti
    }
}
