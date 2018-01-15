<?php

use Illuminate\Database\Seeder;

class TipoPapelSeed extends Seeder
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
            'descripcion' => 'bond de 75 grs'
            ],
            [
             'id' => 2, 
             'descripcion' => 'Offset'
            ],
            [
             'id' => 3, 
             'descripcion' => 'marfil'
            ],
            [
             'id' => 4, 
             'descripcion' => 'Estucado'
            ],
            [
             'id' => 5, 
             'descripcion' => 'vergé'
             ],
            [
             'id' => 6, 
             'descripcion' => 'reciclado'
             ]
        ];

        foreach ($items as $item) {
            \App\TipoPapel::create($item);
        }
    }
}
