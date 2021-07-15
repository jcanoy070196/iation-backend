<?php

namespace Database\Seeders;

use App\Models\CarModel;
use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufacturers = Manufacturer::all();

        foreach ($manufacturers as $manufacturer) {

            for ($i = 1; $i <= 5; $i++) { 
                CarModel::create([
                    'manufacturer_id' => $manufacturer->id,
                    'name' => "Model $i"
                ]);
            }
        }
    }
}
