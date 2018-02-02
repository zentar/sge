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
            'descripcion' => 'Se coloca al crear un libro.'
            ],
                [
            'id' => 2, 
            'nombre' => 'Aprobado',
            'descripcion' => 'Cambia al subir el documento de solicitud de aprobacion.'
            ],
                [
            'id' => 3, 
            'nombre' => 'Edición',
            'descripcion' => 'Llega a este estado cuando se asigna un editor'
            ],
                [
            'id' => 4, 
            'nombre' => 'Cotización',
            'descripcion' => 'LLega cuando se cierra la edicion y se ingresa las caracteristicas'
            ],
                [
            'id' => 5, 
            'nombre' => 'Aprobado Cotización',
            'descripcion' => 'Cuando se escoge la opcion de avanzar estado en cotizaciones'
            ],
            [
            'id' => 6, 
            'nombre' => 'Producción',
            'descripcion' => 'Cuando se sube la cotizacion aprobado'
            ],
                [
            'id' => 7, 
            'nombre' => 'Publicado',
            'descripcion' => 'Llega cuando se sube el documento de entrega a proveeduria'
            ]         
        ];

        foreach ($items as $item) {
            \App\Estados::create($item);
        }
    }
}
