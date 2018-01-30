<?php

use Illuminate\Database\Seeder;

class ColeccionSeed extends Seeder
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
            'titulo' => 'Ciencias Económicas y Administrativas',
            'Descripcion' => 'Descripcion coleccion'
            ],
             [
            'id' => 2, 
            'titulo' => 'Ciencias Sociales y humanidades',
            'Descripcion' => 'Descripcion coleccion'
            ],
             [
            'id' => 3, 
            'titulo' => 'Ciencias de la Salud',
            'Descripcion' => 'Descripcion coleccion'
            ],
            [
            'id' => 4, 
            'titulo' => 'Ciencias Técnicas',
            'Descripcion' => 'Descripcion coleccion'
            ],
            [
           'id' => 5, 
           'titulo' => 'Eventos Academicos',
           'Descripcion' => 'Descripcion coleccion'
           ],
           [
           'id' => 6, 
           'titulo' => 'Publicaciones Seriadas',
           'Descripcion' => 'Descripcion coleccion'
           ]
        ];

     /*   for($i=11;$i<100;$i++){
            array_push($items,['id' => $i, 
            'titulo' => 'Coleccion '.$i,
            'Descripcion' => 'Descripcion coleccion']);
        }*/

        foreach ($items as $item) {
            \App\Coleccion::create($item);
        }
    }
}
