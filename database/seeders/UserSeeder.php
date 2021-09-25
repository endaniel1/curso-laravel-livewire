<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Enrique Rodriguez',
            'email' => 'enriq_1997@hotmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');

        User::factory(30)->create();
    }
}
