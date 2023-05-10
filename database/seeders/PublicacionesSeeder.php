<?php

namespace Database\Seeders;

use App\Models\publicaciones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        publicaciones::create([
            'titulo' => 'Prueba 1',
            'contenido' => 'Esta es una publicacion de prueba No#1',
            'fecha_publicacion' => '2023-05-10 10:41:21',
            'user_id' => 1
        ]);
        publicaciones::create([
            'titulo' => 'Prueba 2',
            'contenido' => 'Esta es una publicacion de prueba No#2',
            'fecha_publicacion' => '2023-05-10 10:41:21',
            'user_id' => 2
        ]);
        publicaciones::create([
            'titulo' => 'Prueba 3',
            'contenido' => 'Esta es una publicacion de prueba No#3',
            'fecha_publicacion' => '2023-05-10 10:41:21',
            'user_id' => 3
        ]);
        publicaciones::create([
            'titulo' => 'Prueba 4',
            'contenido' => 'Esta es una publicacion de prueba No#4',
            'fecha_publicacion' => '2023-05-10 10:41:21',
            'user_id' => 1
        ]);
        publicaciones::create([
            'titulo' => 'Prueba 5',
            'contenido' => 'Esta es una publicacion de prueba No#5',
            'fecha_publicacion' => '2023-05-10 10:41:21',
            'user_id' => 2
        ]);
        publicaciones::create([
            'titulo' => 'Prueba 6',
            'contenido' => 'Esta es una publicacion de prueba No#6',
            'fecha_publicacion' => '2023-05-10 10:41:21',
            'user_id' => 3
        ]);
    }
}
