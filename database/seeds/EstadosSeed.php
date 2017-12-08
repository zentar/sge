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
            'nombre' => 'Ingresado',
            'descripcion' => 'Estado1'
            ],
                [
            'id' => 2, 
            'nombre' => 'Aprobado - Edición',
            'descripcion' => 'Estado2'
            ],
                [
            'id' => 3, 
            'nombre' => 'Edición',
            'descripcion' => 'Estado3'
            ],
                [
            'id' => 4, 
            'nombre' => 'Cotización',
            'descripcion' => 'Estado4'
            ],
                [
            'id' => 5, 
            'nombre' => 'Aprobado - Cotización',
            'descripcion' => 'Estado5'
            ],
                [
            'id' => 6, 
            'nombre' => 'Tramites de documentación',
            'descripcion' => 'Estado6'
            ],
                [
            'id' => 7, 
            'nombre' => 'Producción',
            'descripcion' => 'Estado7'
            ],
                [
            'id' => 8, 
            'nombre' => 'Publicado',
            'descripcion' => 'Estado8'
            ]         
        ];

        foreach ($items as $item) {
            \App\Estados::create($item);
        }
    }
}
