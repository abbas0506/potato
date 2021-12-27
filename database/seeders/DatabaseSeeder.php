<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ConfigSeeder::class,
            BuyerSeeder::class,
            SellerSeeder::class,
            ProductSeeder::class,
            StoreSeeder::class,
            TransporterSeeder::class,
        ]);
    }
}