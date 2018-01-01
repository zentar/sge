<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrador',],
            ['id' => 2, 'title' => 'Usuario Simple',],
            ['id' => 3, 'title' => 'Director',],
            ['id' => 4, 'title' => 'Secretaria Administrativa',],
            ['id' => 5, 'title' => 'Editor',],
            ['id' => 6, 'title' => 'Secretaria Cotizaciones',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
