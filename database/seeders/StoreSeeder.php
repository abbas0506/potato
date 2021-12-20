<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Store::create(['name' => 'Faqih Cold Store, Hujra',]);
        Store::create(['name' => 'Aziz Cold Store, Depalpur',]);
    }
}