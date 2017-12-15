<?php

use Illuminate\Database\Seeder;

class CotizacionesSeed extends Seeder
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
            'imprenta' => 'asdf',
            'tiraje' => 'asdf',
            'valor' => '5',
            'estado' => 1
            ]
        ];

       /* for($i=11;$i<100;$i++){
            array_push($items,['id' => $i, 
            'titulo' => 'Coleccion '.$i,
            'Descripcion' => 'Descripcion coleccion']);
        }*/

        foreach ($items as $item) {
            \App\Cotizaciones::create($item);
        }
    }
}
