<?php

use Illuminate\Database\Seeder;

class ColorPapelSeed extends Seeder
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
            'descripcion' => 'blanco y negro'
            ],
            [
             'id' => 2, 
             'descripcion' => 'colores'
            ],
            [
             'id' => 3, 
             'descripcion' => 'mixto'
            ]
        ];

        foreach ($items as $item) {
            \App\ColorPapel::create($item);
        }
    }
}
