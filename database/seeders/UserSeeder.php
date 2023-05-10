<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Jorge León Caballero',
            'email' => 'leon@doto.com.mx',
            'password' => bcrypt('987654321'),
        ]);
        User::create([
            'name' => 'Prueba 1',
            'email' => 'prueba1@doto.com.mx',
            'password' => bcrypt('987654321'),
        ]);
        User::create([
            'name' => 'Prueba 2',
            'email' => 'prueba2@doto.com.mx',
            'password' => bcrypt('987654321'),
        ]);
    }
}
