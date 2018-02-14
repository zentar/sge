<?php

use Illuminate\Database\Seeder;

class AutorLibroSeed extends Seeder
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
            'autor_id' => 1,
            ],

            [
            'id' => 2, 
            'libro_id' => 2, 
            'autor_id' => 2,
            ],

            [
            'id' => 3, 
            'libro_id' => 2, 
            'autor_id' => 3,
            ],

            [
            'id' => 4, 
            'libro_id' => 2, 
            'autor_id' => 4,
            ],

            [
            'id' => 5, 
            'libro_id' => 3, 
            'autor_id' => 6,
            ],

            [
            'id' => 6, 
            'libro_id' => 4, 
            'autor_id' => 5,
            ],

            [
            'id' => 7, 
            'libro_id' => 4, 
            'autor_id' => 7,
            ],




        ];

        foreach ($items as $item) {            
            \App\autorlibro::create($item);
        }
    }
}
