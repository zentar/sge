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
            'libro_id' => 1,
            'tamano' => 1,                
            'tipopapel_id' => 1, 
            'n_paginas' => 1,
            'colorpapel_id' => 1,
            'cubierta' => 'adasd', 
            'solapas' => 'asdasd', 
            'observaciones' => 'asdasdsd' 
            ],
                   [
            'id' => 2, 
            'libro_id' =>2,
            'tamano' => 1,                
            'tipopapel_id' => 1, 
            'n_paginas' => 1,
            'colorpapel_id' => 1,
            'cubierta' => 'adasd', 
            'solapas' => 'asdasd', 
            'observaciones' => 'asdasdsd' 
            ],
            [
            'id' => 3, 
            'libro_id' => 3,
            'tamano' => 1,                
            'tipopapel_id' => 1, 
            'n_paginas' => 1,
            'colorpapel_id' => 1,
            'cubierta' => 'adasd', 
            'solapas' => 'asdasd', 
            'observaciones' => 'asdasdsd' 
            ],
            [
            'id' => 4, 
            'libro_id' => 4,
            'tamano' => 1,                
            'tipopapel_id' => 1, 
            'n_paginas' => 1,
            'colorpapel_id' => 1,
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
