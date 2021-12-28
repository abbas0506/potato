<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Config::create([
            'reduction0' => 2,
            'reduction1' => 0.5,
            'commission0' => 10,
            'commission1' => 5,
            'bagprice0' => 20,
            'bagprice1' => 10,
            'packing0' => 5,
            'packing1' => 4,
            'loading0' => 10,
            'loading1' => 10,
            'carriage0' => 40,
            'carriage1' => 25,
            'storage0' => 100,
            'storage1' => 60,
        ]);
    }
}