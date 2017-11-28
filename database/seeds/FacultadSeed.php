<?php

use Illuminate\Database\Seeder;

class FacultadSeed extends Seeder
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
            'nombre' => 'Arquitectura y Diseño'
            ],
             [
            'id' => 2, 
            'nombre' => 'Artes y Humanidades'
            ],
             [
            'id' => 3, 
            'nombre' => 'Ciencias Económicas y Administrativas'
            ],
            [
            'id' => 4, 
            'nombre' => 'Ciencias Médicas'
            ],
             [
            'id' => 5, 
            'nombre' => 'Educacion Técnica para Desarrollo'
            ],
             [
            'id' => 6, 
            'nombre' => 'Especialidades Empresariales'
            ],
            [
            'id' => 7, 
            'nombre' => 'Filosofía, Letras y Ciencias'
            ],
            [
            'id' => 8, 
            'nombre' => 'Ingeniería'
            ],
            [
            'id' => 9, 
            'nombre' => 'Jurisprudencia'
            ],
            [
            'id' => 10, 
            'nombre' => 'Aspirantes a Doctorado'
            ]
        ];

        foreach ($items as $item) {
            \App\Facultad::create($item);
        }
    }
}
