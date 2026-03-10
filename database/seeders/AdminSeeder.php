<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@pedulilingkungan.id'],
            [
                'name' => 'Admin Peduli Lingkungan',
                'email' => 'admin@pedulilingkungan.id',
                'password' => bcrypt('purbalinggabersih@2026'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
