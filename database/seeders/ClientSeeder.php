<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Client::create([
            'name' => 'Ali Raza Traders',
            'phone' => '0343-4437491',
            'address' => 'Daula Mustaqeem Depalpur',
        ]);

        Client::create([
            'name' => 'Rana Shehzad Traders',
            'phone' => '0343-4437491',
            'address' => 'Shehzad Traders Depalpur',
        ]);
    }
}