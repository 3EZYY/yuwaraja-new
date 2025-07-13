<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelompok;
use Illuminate\Support\Str;

class KelompokCodeSeeder extends Seeder
{
    public function run(): void
    {
        Kelompok::whereNull('code')->orWhere('code', '')->get()->each(function($k) {
            do {
                $code = strtoupper(Str::random(5));
            } while (Kelompok::where('code', $code)->exists());
            $k->code = $code;
            $k->save();
        });
    }
}
