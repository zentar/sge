<?php

use Illuminate\Database\Seeder;

class TamanoPapelSeed extends Seeder
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
            'descripcion' => 'A1 (594 x 841 mm)'
            ],
            [
             'id' => 2, 
             'descripcion' => 'A2 (420 x 594 mm)'
            ],
            [
             'id' => 3, 
             'descripcion' => 'A3 (297 x 420 mm)'
            ],
            [
             'id' => 4, 
             'descripcion' => 'A4 (210 x 297 mm)'
            ],
            [
             'id' => 5, 
             'descripcion' => 'A5 (148 x 210 mm)'
             ],
            [
             'id' => 6, 
             'descripcion' => 'A6 (105 x 148 mm)'
             ],
            [
             'id' => 7, 
             'descripcion' => 'A7 (74 x 105 mm)'
            ],
            [
             'id' => 8, 
             'descripcion' => 'A8 (52 x 74 mm)'
            ],
            [
             'id' => 9, 
             'descripcion' => 'A9 (37 x 52 mm)'
            ],
            [
              'id' => 10, 
              'descripcion' => 'A10 (26 x 37 mm)'
            ],
            [
                'id' => 11, 
                'descripcion' => '165 X 235 mm'
              ],
        ];

        foreach ($items as $item) {
            \App\TamanoPapel::create($item);
        }
    }
}
