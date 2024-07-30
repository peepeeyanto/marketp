<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class sellerShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'sellert@gmail.com')->first();
        $vendor = new vendor();
        $vendor->banner = 'uploads/123.jpg';
        $vendor->shop_name = 'testshop2';
        $vendor->phone = '2122223';
        $vendor->email = 'sellert@gmail.com';
        $vendor->address = 'usa';
        $vendor->description = 'hello!';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
