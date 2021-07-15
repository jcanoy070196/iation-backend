<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Julius Canoy',
            'email' => 'jcanoy070196@yahoo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('iation.com'), 
        ]);
    }
}
