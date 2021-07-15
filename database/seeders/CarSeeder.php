<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Color;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomModels = CarModel::all()->random(5);
        foreach ($randomModels as $carModel) {
            Car::create([
                "user_id" => 1,
                "name" => "JCar $carModel->name",
                "car_model_id" => $carModel->id,
                "color_id" => Color::inRandomOrder()->first()->id
            ]);
        }
    }
}
