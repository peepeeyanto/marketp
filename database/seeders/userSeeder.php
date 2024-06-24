<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin user',
                'username' => 'adminuser',
                'email' => 'admon@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('passthebutter')
            ],
            [
                'name' => 'seller user',
                'username' => 'selleruser',
                'email' => 'sellert@gmail.com',
                'role' => 'seller',
                'status' => 'active',
                'password' => bcrypt('passthebutter')
            ],
            [
                'name' => 'user',
                'username' => 'usert',
                'email' => 'usert@gmail.com',
                'role' => 'user',
                'status' => 'active',
                'password' => bcrypt('passthebutter')
            ]
        ]);
    }
}
