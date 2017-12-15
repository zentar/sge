<?php

use Illuminate\Database\Seeder;

class CaracteristicasSeed extends Seeder
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
            'book_id' => 1,
            'tamano' => 1,                
            'tipo_papel' => 1, 
            'n_paginas' => 1,
            'color' => 1,
            'cubierta' => 'adasd', 
            'solapas' => 'asdasd', 
            'observaciones' => 'asdasdsd' 
            ],
                   [
            'id' => 2, 
            'book_id' =>2,
            'tamano' => 1,                
            'tipo_papel' => 1, 
            'n_paginas' => 1,
            'color' => 1,
            'cubierta' => 'adasd', 
            'solapas' => 'asdasd', 
            'observaciones' => 'asdasdsd' 
            ],
            [
            'id' => 3, 
            'book_id' => 3,
            'tamano' => 1,                
            'tipo_papel' => 1, 
            'n_paginas' => 1,
            'color' => 1,
            'cubierta' => 'adasd', 
            'solapas' => 'asdasd', 
            'observaciones' => 'asdasdsd' 
            ],
            [
            'id' => 4, 
            'book_id' => 4,
            'tamano' => 1,                
            'tipo_papel' => 1, 
            'n_paginas' => 1,
            'color' => 1,
            'cubierta' => 'adasd', 
            'solapas' => 'asdasd', 
            'observaciones' => 'asdasdsd' 
            ]

        ];       

        foreach ($items as $item) {
            \App\Caracteristicas::create($item);
        }
    }
}
