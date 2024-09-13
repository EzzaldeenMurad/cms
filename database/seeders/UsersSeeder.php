<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => "Eyad Hasan",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('11111111'),
            'role_id' => 1
        ]);


        DB::table('users')->insert([
            'id' => 2,
            'name' => "Hasan dani",
            'email' => "user@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('11111111'),
            'role_id' => 2,
        ]);


        DB::table('users')->insert([
            'id' => 3,
            'name' => "Mohamed Ali",
            'email' => "user2@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('11111111'),
            'role_id' => 2,
        ]);
    }
}
