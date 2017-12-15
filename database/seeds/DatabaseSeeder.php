<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);       
        $this->call(FacultadSeed::class);        
        $this->call(EstadosSeed::class);
        $this->call(TipoDocSeed::class);
        $this->call(ColeccionSeed::class);
        
        $this->call(LibroSeed::class);
        $this->call(CaracteristicasSeed::class);
        $this->call(AutoresSeed::class);
        $this->call(AutorBookSeed::class);
     
    }
}
