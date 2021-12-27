<?php

namespace Database\Seeders;

use App\Models\Buyer;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Buyer::create([
            'name' => 'Ali Raza Traders',
            'phone' => '0343-4437491',
            'address' => 'Daula Mustaqeem Depalpur',
        ]);

        Buyer::create([
            'name' => 'Rana Shehzad Traders',
            'phone' => '0343-4437491',
            'address' => 'Shehzad Traders Depalpur',
        ]);
    }
}