<?php

use Illuminate\Database\Seeder;

class EstadosSeed extends Seeder
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
            'nombre' => 'Estado1',
            'descripcion' => 'Estado1'
            ],
                [
            'id' => 2, 
            'nombre' => 'Estado2',
            'descripcion' => 'Estado2'
            ],
                [
            'id' => 3, 
            'nombre' => 'Estado3',
            'descripcion' => 'Estado3'
            ],
                [
            'id' => 4, 
            'nombre' => 'Estado4',
            'descripcion' => 'Estado4'
            ],
                [
            'id' => 5, 
            'nombre' => 'Estado5',
            'descripcion' => 'Estado5'
            ],
                [
            'id' => 6, 
            'nombre' => 'Estado6',
            'descripcion' => 'Estado6'
            ],
                [
            'id' => 7, 
            'nombre' => 'Estado7',
            'descripcion' => 'Estado7'
            ],
                [
            'id' => 8, 
            'nombre' => 'Estado8',
            'descripcion' => 'Estado8'
            ],
                [
            'id' => 9, 
            'nombre' => 'Estado9',
            'descripcion' => 'Estado9'
            ],
                [
            'id' => 10, 
            'nombre' => 'Estado10',
            'descripcion' => 'Estado10'
            ]
         
        ];

        foreach ($items as $item) {
            \App\Estados::create($item);
        }
    }
}
