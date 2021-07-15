<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->insert([
            ['name' => 'Honda', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suzuki', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hyundai', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'BMW', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Subaru', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ford', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
