<?php

use Illuminate\Database\Seeder;

class HistorialSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
            'id' => 1, 
            'libro_id' => 1,
            'descripcion' => "Creación de libro, estado ingresado"
            ],
            [
            'id' => 2, 
            'libro_id' => 2,
            'descripcion' => "Creación de libro, estado ingresado" 
            ],
            [
            'id' => 3, 
            'libro_id' => 3,
            'descripcion' => "Creación de libro, estado ingresado"
            ],
            [
          'id' => 4, 
            'libro_id' => 4,
            'descripcion' => "Creación de libro, estado ingresado"
            ]

        ];       

        foreach ($items as $item) {
            \App\Historial::create($item);
        }
    }
}
