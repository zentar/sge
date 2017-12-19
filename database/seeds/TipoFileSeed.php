<?php

use Illuminate\Database\Seeder;

class TipoDocSeed extends Seeder
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
            'nombre' => 'Cotizacion',
            'descripcion' => 'Cotizacion'
            ],
            [
            'id' => 2, 
            'nombre' => 'Contrato',
            'descripcion' => 'Contrato'
            ],
                [
            'id' => 3, 
            'nombre' => 'ISBN - Papeleta de pago',
            'descripcion' => 'ISBN - Papeleta de pago'
            ],
                [
            'id' => 4, 
            'nombre' => 'ISBN - Formulario de Registro',
            'descripcion' => 'ISBN - Formulario de Registro'
            ],
                [
            'id' => 5, 
            'nombre' => 'ISBN - Código',
            'descripcion' => 'ISBN - Código'
            ],
                [
            'id' => 6, 
            'nombre' => 'PI',
            'descripcion' => 'PI'
            ],
                [
            'id' => 7, 
            'nombre' => 'IEPI - Solicitud',
            'descripcion' => 'IEPI - Solicitud'
            ],
            [
            'id' => 8, 
            'nombre' => 'IEPI - Papeleta pago',
            'descripcion' => 'IEPI - Papeleta pago'
            ],
            [
            'id' => 9, 
            'nombre' => 'IEPI - código',
            'descripcion' => 'IEPI - código'
            ],
             [
            'id' => 10, 
            'nombre' => 'Cédula',
            'descripcion' => 'Cédula'
            ],
            [
            'id' => 11, 
            'nombre' => 'Pasaporte',
            'descripcion' => 'Pasaporte'
            ],         
            [
            'id' => 12, 
            'nombre' => 'Otros',
            'descripcion' => 'Otros'
            ]              
        ];

        foreach ($items as $item) {
            \App\Tipodoc::create($item);
        }
    }
}
