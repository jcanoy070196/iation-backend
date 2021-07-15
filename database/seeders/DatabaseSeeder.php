<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
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
        $this->call(UserSeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(CarModelSeeder::class);
    }
}
