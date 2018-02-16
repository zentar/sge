<?php

use Illuminate\Database\Seeder;

class CampoEspecificoSeed extends Seeder
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
            'codigo' => '011',
            'campo_general' => 1
            ],
             [
            'id' => 2, 
            'titulo' => 'Artes',
             'codigo' => '021',
             'campo_general' => 2
            ],
             [
            'id' => 3, 
            'titulo' => 'Humanidades (excepto idiomas)',
             'codigo' => '022',
             'campo_general' => 2
            ],
            [
            'id' => 4, 
            'titulo' => 'Idiomas',
             'codigo' => '023',
             'campo_general' => 2
            ],
             [
            'id' => 5, 
            'titulo' => 'Ciencias sociales y del comportamiento',
             'codigo' => '031',
             'campo_general' => 3
            ],
             [
            'id' => 6, 
            'titulo' => 'Periodismo e información',
             'codigo' => '032',
             'campo_general' => 3
            ],
            [
            'id' => 7, 
            'titulo' => 'Educación comercial y administración',
             'codigo' => '041',
             'campo_general' => 4
            ],
            [
            'id' => 8, 
            'titulo' => 'Derecho',
             'codigo' => '042',
             'campo_general' => 4
            ],
            [
            'id' => 9, 
            'titulo' => 'Ciencias biológicas y afines',
             'codigo' => '051',
             'campo_general' => 5
            ],
            [
            'id' => 10, 
            'titulo' => 'Medio ambiente',
             'codigo' => '052',
             'campo_general' => 5
            ],
            [
                'id' => 11, 
                'titulo' => 'Ciencias físicas',
                'codigo' => '053',
                'campo_general' => 5
                ],
                 [
                'id' => 12, 
                'titulo' => ' Matemáticas y estadística',
                 'codigo' => '054',
                 'campo_general' => 5
                ],
                 [
                'id' => 13, 
                'titulo' => 'Tecnologías de la información y la comunicación (TIC)',
                 'codigo' => '061',
                 'campo_general' => 6
                ],
                [
                'id' => 14, 
                'titulo' => 'Ingeniería y profesiones afines',
                 'codigo' => '071',
                 'campo_general' => 7
                ],
                 [
                'id' => 15, 
                'titulo' => 'Industria y producción',
                 'codigo' => '072',
                 'campo_general' => 7
                ],
                 [
                'id' => 16, 
                'titulo' => 'Arquitectura y construcción',
                 'codigo' => '073',
                 'campo_general' => 7
                ],
                [
                'id' => 17, 
                'titulo' => 'Agricultura',
                 'codigo' => '081',
                 'campo_general' => 8
                ],
                [
                'id' => 18, 
                'titulo' => 'Silvicultura',
                 'codigo' => '082',
                 'campo_general' => 8
                ],
                [
                'id' => 19, 
                'titulo' => 'Pesca',
                 'codigo' => '083',
                 'campo_general' => 8
                ],
                [
                'id' => 20, 
                'titulo' => 'Veterinaria',
                 'codigo' => '084',
                 'campo_general' => 8
                ],
                [
                    'id' => 21, 
                    'titulo' => 'Salud',
                     'codigo' => '091',
                     'campo_general' => 9
                    ],
                    [
                    'id' => 22, 
                    'titulo' => 'Bienestar',
                     'codigo' => '092',
                     'campo_general' => 9
                    ],
                    [
                    'id' => 23, 
                    'titulo' => ' Servicios personales',
                     'codigo' => '101',
                     'campo_general' => 10
                    ],
                    [
                    'id' => 24, 
                    'titulo' => 'Servicios de higiene y salud ocupaciona',
                     'codigo' => '102',
                     'campo_general' => 10
                    ],
                    [
                    'id' => 25, 
                    'titulo' => 'Servicios de seguridad',
                     'codigo' => '103',
                     'campo_general' => 10
                    ]
        ];

        foreach ($items as $item) {
            \App\CampoEspecifico::create($item);
        }
    }
}
