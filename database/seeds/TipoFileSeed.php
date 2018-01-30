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
            'grupo' => "cotizacion", 
            'nombre' => 'Cotizacion',
            'descripcion' => 'Cotizacion'
            ],
            [
            'id' => 2,
            'grupo' => "cotizacion", 
            'nombre' => 'Cotizacion Aprobado',
            'descripcion' => 'Cotizacion'
            ], 
            [
            'id' => 3,
            'grupo' => "libro", 
            'nombre' => 'Contrato',
            'descripcion' => 'Contrato'
            ],
                [
            'id' => 4,
            'grupo' => "libro", 
            'nombre' => 'ISBN - Papeleta de pago',
            'descripcion' => 'ISBN - Papeleta de pago'
            ],
                [
            'id' => 5,
            'grupo' => "libro", 
            'nombre' => 'ISBN - Formulario de Registro',
            'descripcion' => 'ISBN - Formulario de Registro'
            ],
                [
            'id' => 6,
            'grupo' => "libro", 
            'nombre' => 'ISBN - Código',
            'descripcion' => 'ISBN - Código'
            ],
                [
            'id' => 7,
            'grupo' => "libro", 
            'nombre' => 'PI',
            'descripcion' => 'PI'
            ],
                [
            'id' => 8,
            'grupo' => "libro", 
            'nombre' => 'IEPI - Solicitud',
            'descripcion' => 'IEPI - Solicitud'
            ],
            [
            'id' => 9,
            'grupo' => "libro", 
            'nombre' => 'IEPI - Papeleta pago',
            'descripcion' => 'IEPI - Papeleta de pago'
            ],
            [
            'id' => 10,
            'grupo' => "libro", 
            'nombre' => 'IEPI - Código',
            'descripcion' => 'IEPI - Código'
            ],
             [
            'id' => 11,
            'grupo' => "autor", 
            'nombre' => 'Cédula',
            'descripcion' => 'Cédula'
            ],
            [
            'id' => 12,
            'grupo' => "autor", 
            'nombre' => 'Pasaporte',
            'descripcion' => 'Pasaporte'
            ],                     
            [
            'id' => 13,
            'grupo' => "libro", 
            'nombre' => 'Solicitud de Aprobación',
            'descripcion' => 'Solicitud de Aprobación'
            ],                                 
            [
            'id' => 14,
            'grupo' => "libro_especial", 
            'nombre' => 'Original',
            'descripcion' => 'Original'
            ],                                  
            [
            'id' => 15,
            'grupo' => "libro_especial", 
            'nombre' => 'Cubierta',
            'descripcion' => 'Cubierta'
            ],                                 
            [
            'id' => 16,
            'grupo' => "libro_especial", 
            'nombre' => 'Contenido',
            'descripcion' => 'Contenido'
            ],          
            [
            'id' => 17,
            'grupo' => "autor", 
            'nombre' => 'Varios',
            'descripcion' => 'Varios'
            ],         
            [
            'id' => 18,
            'grupo' => "libro", 
            'nombre' => 'Varios',
            'descripcion' => 'Varios'
            ],         
            [
            'id' => 19,
            'grupo' => "libro", 
            'nombre' => 'Acta de entrega a Proveeduria',
            'descripcion' => 'Acta de entrega a Proveeduria'
            ],          
            [
            'id' => 20,
            'grupo' => "original", 
            'nombre' => 'Original',
            'descripcion' => 'Original'
            ],         
            [
            'id' => 21,
            'grupo' => "cubierta", 
            'nombre' => 'Cubierta',
            'descripcion' => 'Cubierta'
            ],         
            [
            'id' => 22,
            'grupo' => "contenido", 
            'nombre' => 'Contenido',
            'descripcion' => 'Contenido'
            ]               
        ];

        foreach ($items as $item) {
            \App\Tipodoc::create($item);
        }
    }
}
