<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sala;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sala::create([
            'nombre' => 'Sala A',
            'descripcion' => 'Sala para menores de edad'
        ]);
        Sala::create([
            'nombre' => 'Sala B',
            'descripcion' => 'Sala de adultos fumadores'
        ]);
        Sala::create([
            'nombre' => 'Sala C',
            'descripcion' => 'Sala de adultos no fumadores'
        ]);
    }
}
