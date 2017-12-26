<?php

use Illuminate\Database\Seeder;

class ColeccionSeed extends Seeder
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
            'titulo' => 'Coleccion 1',
            'Descripcion' => 'Descripcion coleccion'
            ],
             [
            'id' => 2, 
            'titulo' => 'Coleccion 2',
            'Descripcion' => 'Descripcion coleccion'
            ],
             [
            'id' => 3, 
            'titulo' => 'Coleccion 3',
            'Descripcion' => 'Descripcion coleccion'
            ],
            [
            'id' => 4, 
            'titulo' => 'Coleccion 4',
            'Descripcion' => 'Descripcion coleccion'
            ],
             [
            'id' => 5, 
            'titulo' => 'Coleccion 5',
            'Descripcion' => 'Descripcion coleccion'
            ],
             [
            'id' => 6, 
            'titulo' => 'Coleccion 6',
            'Descripcion' => 'Descripcion coleccion'
            ],
            [
            'id' => 7, 
            'titulo' => 'Coleccion 7',
            'Descripcion' => 'Descripcion coleccion'
            ],
            [
            'id' => 8, 
            'titulo' => 'Coleccion 8',
            'Descripcion' => 'Descripcion coleccion'
            ],
            [
            'id' => 9, 
            'titulo' => 'Coleccion 9',
            'Descripcion' => 'Descripcion coleccion'
            ],
            [
            'id' => 10, 
            'titulo' => 'Coleccion 10',
            'Descripcion' => 'Descripcion coleccion'
            ]
        ];

     /*   for($i=11;$i<100;$i++){
            array_push($items,['id' => $i, 
            'titulo' => 'Coleccion '.$i,
            'Descripcion' => 'Descripcion coleccion']);
        }*/

        foreach ($items as $item) {
            \App\Coleccion::create($item);
        }
    }
}
