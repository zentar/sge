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
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$RP3ycJqWZIMUhaq/8vo0JOEwDgnKpRF6dOi1xOnBQpxZ2/sffCvl6', 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'Carlos', 'email' => 'carlos@carlos.com', 'password' => 'lj4Njh5ninnsbIMauy6wUMC2ZAFfrazDRD6N0MslBwf2oi32NHoWsFCZpTpY', 'role_id' => 2, 'remember_token' => '',],


        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
