<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create(['name' => 'Santa']);
        Product::create(['name' => 'Red Potato']);
        Product::create(['name' => 'White Potato']);
    }
}