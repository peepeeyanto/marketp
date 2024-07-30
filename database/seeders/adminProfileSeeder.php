<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admon@gmail.com')->first();
        $vendor = new vendor();
        $vendor->banner = 'uploads/123.jpg';
        $vendor->shop_name = 'testshop1';
        $vendor->phone = '2122222';
        $vendor->email = 'admon@gmail.com';
        $vendor->address = 'usa';
        $vendor->description = 'hello';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
