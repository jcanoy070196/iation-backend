<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('colors')->insert([
            ['name' => 'Red', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blue', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yellow', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Orange', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Green', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Violet', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
