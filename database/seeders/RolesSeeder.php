<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'id' => 1,
            'role' => 'مدير'
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role' => 'مستخدم جديد'
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'role' => 'مستخدم فعال'
        ]);
    }
}
