<?php

use Illuminate\Database\Seeder;

class AutorBookSeed extends Seeder
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
            'autor_id' => 1,
            ],

            [
            'id' => 2, 
            'book_id' => 2, 
            'autor_id' => 2,
            ],

            [
            'id' => 3, 
            'book_id' => 2, 
            'autor_id' => 3,
            ],

            [
            'id' => 4, 
            'book_id' => 2, 
            'autor_id' => 4,
            ],

            [
            'id' => 5, 
            'book_id' => 3, 
            'autor_id' => 6,
            ],

            [
            'id' => 6, 
            'book_id' => 4, 
            'autor_id' => 5,
            ],

            [
            'id' => 7, 
            'book_id' => 4, 
            'autor_id' => 7,
            ],




        ];

        foreach ($items as $item) {            
            \App\autorbook::create($item);
        }
    }
}
