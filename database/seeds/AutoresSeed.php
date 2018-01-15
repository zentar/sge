<?php

use Illuminate\Database\Seeder;

class AutoresSeed extends Seeder
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
            'cedula' => '089874091', 
            'nombre' => 'Mauro',
            'apellido' => 'Toscanini Segale',
            'email' => 'mauro.toscanini@cu.ucsg.edu.ec', 
            'telefono' => '60042739',
            'filiacion' => '978-9942-904-62-1',
            ],

            [
            'id' => 2, 
            'cedula' => '089874091', 
            'nombre' => 'Uriel',
            'apellido' => 'Castillo Nazareno',
            'email' => 'uriel.castillo@cu.ucsg.edu.ec', 
            'telefono' => '60047398',
            'filiacion' => '978-9942-904-62-1',

            ],

               [
            'id' => 3, 
            'cedula' => '089874091', 
            'nombre' => 'Jack',
            'apellido' => 'Chávez García',
            'email' => 'jack.garcia@cu.ucsg.edu.ec', 
            'telefono' => '60047896',
            'filiacion' => '978-9942-904-62-1',
            ],

            [
            'id' => 4, 
            'cedula' => '089874091', 
            'nombre' => 'Teresa',
            'apellido' => 'Alcívar Avilés',
            'email' => 'teresa.alcivar@cu.ucsg.edu.ec', 
            'telefono' => '7047739',
            'filiacion' => '978-9942-904-62-1',
            ],

               [
            'id' => 5, 
            'cedula' => '089874091', 
            'nombre' => 'Ariamnis',
            'apellido' => 'Tomasa Alcazar Quiñones',
            'email' => 'ariamnis.tomasa@cu.ucsg.edu.ec', 
            'telefono' => '9047739',
            'filiacion' => '978-9942-904-62-1',
            ],

            [
            'id' => 6, 
            'cedula' => '089874091', 
            'nombre' => 'Roxana',
            'apellido' => 'Fernández Berducci',
            'email' => 'roxana.fernandez@cu.ucsg.edu.ec', 
            'telefono' => '8047739',
            'filiacion' => '978-9942-904-62-1',
            ],

               [
            'id' => 7, 
            'cedula' => '089874091', 
            'nombre' => ' Tamara',
            'apellido' => 'Proenza Díaz',
            'email' => 'tamara.proenza@cu.ucsg.edu.ec', 
            'telefono' => '6047739',
            'filiacion' => '978-9942-904-62-1',
            ]      


        ];

        foreach ($items as $item) {
            \App\Autor::create($item);
        }
    }
}
