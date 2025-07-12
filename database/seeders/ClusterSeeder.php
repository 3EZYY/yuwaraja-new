<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClusterSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user_id penanggung jawab
        $hanin = DB::table('users')->where('username', 'hanin')->first();
        $wawa = DB::table('users')->where('username', 'wawa')->first();

        // Cluster Alpha, penanggung jawab Hanin
        DB::table('clusters')->updateOrInsert([
            'name' => 'Cluster Alpha',
        ], [
            'user_id' => $hanin ? $hanin->id : null,
        ]);

        // Cluster Beta, penanggung jawab Wawa
        DB::table('clusters')->updateOrInsert([
            'name' => 'Cluster Beta',
        ], [
            'user_id' => $wawa ? $wawa->id : null,
        ]);
    }
}
