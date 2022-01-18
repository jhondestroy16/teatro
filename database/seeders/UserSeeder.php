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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'genero' => 'Masculino',
            'edad' => 23,
            'fumador' => 'Si',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');
    }
}
