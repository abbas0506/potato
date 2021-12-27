<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Seller::create([
            'name' => 'Abdul Hameed',
            'phone' => '0343-4437491',
            'address' => 'Daula Mustaqeem Depalpur',
        ]);

        Seller::create([
            'name' => 'Nasir Ali',
            'phone' => '0343-4437491',
            'address' => 'Shehzad Traders Depalpur',
        ]);

        Seller::create([
            'name' => 'Bashir Hussain',
            'phone' => '0343-4437491',
            'address' => 'Shehzad Traders Depalpur',
        ]);
    }
}