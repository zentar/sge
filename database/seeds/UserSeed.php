<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'Gestor Admin', 'email' => 'gestorad@gestorad.com', 'password' => bcrypt('gestorad'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 3, 'name' => 'Gestor Prod', 'email' => 'gestorpr@gestorpr.com', 'password' => bcrypt('gestorpr'), 'role_id' => 3, 'remember_token' => '',],
            ['id' => 4, 'name' => 'Editor', 'email' => 'editor@editor.com', 'password' => bcrypt('editor'), 'role_id' => 4, 'remember_token' => '',]
        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
