<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            'id' => 1,
            'user_id' => 2,
            'post_id' => 2,
            'post_userId' => 1,
            'created_at' =>'2022-05-05 05:08:00',
        ]);

        DB::table('notifications')->insert([
            'id' => 2,
            'user_id' => 2,
            'post_id' => 3,
            'post_userId' => 1,
            'created_at' =>'2022-05-05 06:08:00',
        ]);

        DB::table('notifications')->insert([
            'id' => 3,
            'user_id' => 3,
            'post_id' => 4,
            'post_userId' => 2,
            'created_at' =>'2022-05-05 07:08:00',
        ]);
    }
}
