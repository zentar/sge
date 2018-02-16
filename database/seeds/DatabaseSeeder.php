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
        $this->call(TamanoPapelSeed::class);
        $this->call(TipoPapelSeed::class);
        $this->call(ColorPapelSeed::class);
        
        $this->call(CampoGeneralSeed::class);
        $this->call(CampoEspecificoSeed::class);
        $this->call(CampoDetalladoSeed::class);
        
        $this->call(LibroSeed::class);
        $this->call(HistorialSeed::class);
        $this->call(CaracteristicasSeed::class);
        $this->call(AutoresSeed::class);
        $this->call(AutorLibroSeed::class);
     
    }
}
