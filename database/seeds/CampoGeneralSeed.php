<?php

use Illuminate\Database\Seeder;

class CampoGeneralSeed extends Seeder
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
            'titulo' => 'Educación',
            'codigo' => '01'
            ],
             [
            'id' => 2, 
            'titulo' => 'Artes y Humanidades',
            'codigo' => '02'
            ],
             [
            'id' => 3, 
            'titulo' => 'Ciencias Sociales, periodismo e información',
             'codigo' => '03'
            ],
            [
            'id' => 4, 
            'titulo' => 'Administración de empresas y derecho',
             'codigo' => '04'
            ],
             [
            'id' => 5, 
            'titulo' => 'Ciencias naturales, matemáticas y estadística',
             'codigo' => '05'
            ],
             [
            'id' => 6, 
            'titulo' => 'Tecnologías de la información y la comunicación (TIC)',
             'codigo' => '06'
            ],
            [
            'id' => 7, 
            'titulo' => ' Ingeniería, industria y construcción',
             'codigo' => '07'
            ],
            [
            'id' => 8, 
            'titulo' => 'Agricultura, silvicultura, pesca y veterinaria',
             'codigo' => '08'
            ],
            [
            'id' => 9, 
            'titulo' => 'Salud y bienestar',
             'codigo' => '09'
            ],
            [
            'id' => 10, 
            'titulo' => 'Servicios',
             'codigo' => '10'
            ]
        ];

        foreach ($items as $item) {
            \App\CampoGeneral::create($item);
        }
    }
}
