<?php

use Illuminate\Database\Seeder;

class CampoDetalladoSeed extends Seeder
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
            'titulo' => 'Ciencias de la educación',
            'codigo' => '0111',
            'campo_especifico' => 1
            ],
             [
            'id' => 2, 
            'titulo' => 'Formación para docentes de educación preprimaria',
             'codigo' => '0112',
             'campo_especifico' => 1
            ],
             [
            'id' => 3, 
            'titulo' => 'Formación para docentes sin asignatura de especialización ',
             'codigo' => '0113',
             'campo_especifico' => 1
            ],
            [
            'id' => 4, 
            'titulo' => ' Formación para docentes con asignatura de especialización',
             'codigo' => '0114',
             'campo_especifico' => 1
            ],
             [
            'id' => 5, 
            'titulo' => 'Técnicas audiovisuales y producción para medios de comunicación',
             'codigo' => '0211',
             'campo_especifico' => 2
            ],
             [
            'id' => 6, 
            'titulo' => ' Diseño industrial, de modas e interiores',
             'codigo' => '0212',
             'campo_especifico' => 2
            ],
            [
            'id' => 7, 
            'titulo' => ' Bellas artes',
             'codigo' => '0213',
             'campo_especifico' => 2
            ],
            [
            'id' => 8, 
            'titulo' => 'Artesanías',
             'codigo' => '0214',
             'campo_especifico' => 2
            ],
            [
            'id' => 9, 
            'titulo' => 'Música y artes escénicas',
             'codigo' => '0215',
             'campo_especifico' => 2
            ],
            [
            'id' => 10, 
            'titulo' => 'Religión y teología',
             'codigo' => '0221',
             'campo_especifico' => 3
            ],
            [
            'id' => 11, 
            'titulo' => 'Historia y arqueología ',
             'codigo' => '0222',
             'campo_especifico' => 3
            ],
            [
            'id' => 12, 
            'titulo' => 'Filosofía y ética',
             'codigo' => '0223',
             'campo_especifico' => 3
            ],
            [
            'id' => 13, 
            'titulo' => 'Adquisición del lenguaje',
             'codigo' => '0231',
             'campo_especifico' => 4
            ],
            [
            'id' => 14, 
            'titulo' => 'Literatura y lingüística',
             'codigo' => '0232',
             'campo_especifico' => 4
            ],
            [
            'id' => 15, 
            'titulo' => 'Economía',
             'codigo' => '0311',
             'campo_especifico' => 5
            ],
            [
            'id' => 16, 
            'titulo' => ' Ciencias políticas y educación cívica',
             'codigo' => '0312',
             'campo_especifico' => 5
            ],
            [
            'id' => 17, 
            'titulo' => 'Psicología',
             'codigo' => '0313',
             'campo_especifico' => 5
            ],
            [
            'id' => 18, 
            'titulo' => 'Sociología y estudios culturales',
             'codigo' => '0314',
             'campo_especifico' => 5
            ],
            [
            'id' => 19, 
            'titulo' => ' Periodismo y reportajes',
             'codigo' => '0321',
             'campo_especifico' => 6
            ],
            [
            'id' => 20, 
            'titulo' => 'Bibliotecología, información y archivología',
             'codigo' => '0322',
             'campo_especifico' => 6
            ],
            [
            'id' => 21, 
            'titulo' => 'Contabilidad e impuestos',
             'codigo' => '0411',
             'campo_especifico' => 7
            ],
            [
            'id' => 22, 
            'titulo' => 'Gestión financiera, administración
            bancaria y seguros',
             'codigo' => '0412',
             'campo_especifico' => 7
            ],
            [
            'id' => 23, 
            'titulo' => 'Gestión y administración',
             'codigo' => '0413',
             'campo_especifico' => 7
            ],
            [
            'id' => 24, 
            'titulo' => 'Mercadotecnia y publicidad',
             'codigo' => '0414',
             'campo_especifico' => 7
            ],
            [
            'id' => 25, 
            'titulo' => 'Secretariado y trabajo de oficina',
             'codigo' => '0415',
             'campo_especifico' => 7
            ],
            [
            'id' => 26, 
            'titulo' => 'Ventas al por mayor y al por menor',
             'codigo' => '0416',
             'campo_especifico' => 7
            ],
            [
            'id' => 27, 
            'titulo' => 'Competencias laborales',
             'codigo' => '0417',
             'campo_especifico' => 7
            ],
            [
            'id' => 28, 
            'titulo' => 'Derecho',
             'codigo' => '0421',
             'campo_especifico' => 8
            ],
            [
            'id' => 29, 
            'titulo' => 'Biología',
             'codigo' => '0417',
             'campo_especifico' => 9
            ],
            [
            'id' => 30, 
            'titulo' => 'Bioquímica',
             'codigo' => '0421',
             'campo_especifico' => 9
            ],
            [
            'id' => 31, 
            'titulo' => 'Ciencias del medio ambiente',
             'codigo' => '0521',
             'campo_especifico' => 10
            ],
            [
            'id' => 32, 
            'titulo' => 'Medio ambientes naturales y vida silvestre',
             'codigo' => '0522',
             'campo_especifico' => 10
            ],
            [
            'id' => 33, 
            'titulo' => 'Química',
             'codigo' => '0531',
             'campo_especifico' =>11
            ],
            [
            'id' => 34, 
            'titulo' => 'Ciencias de la tierra',
             'codigo' => '0532',
             'campo_especifico' => 11
            ],
            [
            'id' => 35, 
            'titulo' => 'Física',
             'codigo' => '0533',
             'campo_especifico' => 11
            ],
            [
            'id' => 36, 
            'titulo' => 'Matemáticas',
             'codigo' => '0541',
             'campo_especifico' => 12
            ],
            [
            'id' => 37, 
            'titulo' => 'Estadística',
             'codigo' => '0542',
             'campo_especifico' => 12
            ],
            [
            'id' => 38, 
            'titulo' => 'Uso de computadores',
             'codigo' => '0611',
             'campo_especifico' => 13
            ],
            [
            'id' => 39, 
            'titulo' => ' Diseño y administración de redes y bases de datos',
             'codigo' => '0612',
             'campo_especifico' => 13
            ],
            [
            'id' => 40, 
            'titulo' => 'Desarrollo y análisis de software y aplicaciones',
             'codigo' => '0613',
             'campo_especifico' => 13
            ],
            [
            'id' => 41, 
            'titulo' => 'Ingeniería y procesos químicos',
             'codigo' => '0711',
             'campo_especifico' => 14
            ],
            [
            'id' => 42, 
            'titulo' => 'Tecnología de protección del medio ambiente',
             'codigo' => '0712',
             'campo_especifico' => 14
            ],
            [
            'id' => 43, 
            'titulo' => 'Electricidad y energía',
             'codigo' => '0713',
             'campo_especifico' => 14
            ],
            [
            'id' => 44, 
            'titulo' => 'Electrónica y automatización',
             'codigo' => '0714',
             'campo_especifico' => 14
            ],
            [
            'id' => 45, 
            'titulo' => 'Mecánica y profesiones afines a la metalistería',
             'codigo' => '0715',
             'campo_especifico' => 14
            ],
            [
            'id' => 46, 
            'titulo' => 'Vehículos, barcos y aeronaves motorizadas',
             'codigo' => '0716',
             'campo_especifico' => 14
            ],
            [
            'id' => 47, 
            'titulo' => 'Procesamiento de alimentos',
             'codigo' => '0721',
             'campo_especifico' => 15
            ],
            [
            'id' => 48, 
            'titulo' => 'Materiales (vidrio, papel, plástico y madera)',
             'codigo' => '0722',
             'campo_especifico' => 15
            ],
            [
            'id' => 49, 
            'titulo' => 'Productos textiles (ropa, calzado y artículos de cuero)',
             'codigo' => '0723',
             'campo_especifico' => 15
            ],
            [
            'id' => 50, 
            'titulo' => 'Minería y extracción',
             'codigo' => '0724',
             'campo_especifico' => 15
            ],
            [
            'id' => 51, 
            'titulo' => 'Arquitectura y urbanismo',
             'codigo' => '0731',
             'campo_especifico' => 16
            ],
            [
            'id' => 52, 
            'titulo' => 'Construcción e ingeniería civil',
             'codigo' => '0732',
             'campo_especifico' => 16
            ],
            [
            'id' => 53, 
            'titulo' => 'Producción agrícola y ganadera',
             'codigo' => '0811',
             'campo_especifico' => 17
            ],
            [
            'id' => 54, 
            'titulo' => 'Horticultura',
             'codigo' => '0812',
             'campo_especifico' => 17
            ],
            [
            'id' => 55, 
            'titulo' => 'Silvicultura',
             'codigo' => '0821',
             'campo_especifico' => 18
            ],
            [
            'id' => 56, 
            'titulo' => 'Pesca',
             'codigo' => '0831',
             'campo_especifico' => 19
            ],
            [
            'id' => 57, 
            'titulo' => 'Veterinaria',
             'codigo' => '0841',
             'campo_especifico' => 20
            ],

            [
            'id' => 58, 
            'titulo' => 'Odontología',
             'codigo' => '0911',
             'campo_especifico' => 21
            ],
            [
            'id' => 59, 
            'titulo' => 'Medicina',
             'codigo' => '0912',
             'campo_especifico' => 21
            ],
            [
            'id' => 60, 
            'titulo' => 'Enfermería y partería',
             'codigo' => '0913',
             'campo_especifico' => 21
            ],
            [
            'id' => 61, 
            'titulo' => 'Tecnología de diagnóstico y tratamiento médico',
             'codigo' => '0914',
             'campo_especifico' => 21
            ],
            [
            'id' => 62, 
            'titulo' => 'Terapia y rehabilitación',
             'codigo' => '0915',
             'campo_especifico' => 21
            ],
            [
            'id' => 63, 
            'titulo' => 'Farmacia',
             'codigo' => '0916',
             'campo_especifico' => 21
            ],
            [
            'id' => 64, 
            'titulo' => 'Medicina y terapia tradicional y complementaria',
             'codigo' => '0917',
             'campo_especifico' => 21
            ],
            [
            'id' => 65, 
            'titulo' => 'Asistencia a adultos mayores y discapacitados',
             'codigo' => '0921',
             'campo_especifico' => 22
            ],
            [
            'id' => 66, 
            'titulo' => 'Asistencia a la infancia y servicios para jóvenes',
             'codigo' => '0922',
             'campo_especifico' => 22
            ],
            [
            'id' => 67, 
            'titulo' => 'Trabajo social y orientación',
             'codigo' => '0923',
             'campo_especifico' => 22
            ],
            [
            'id' => 68, 
            'titulo' => 'Servicios domésticos',
             'codigo' => '1011',
             'campo_especifico' => 23
            ],
            [
            'id' => 69, 
            'titulo' => 'Peluquería y tratamientos de belleza',
             'codigo' => '1012',
             'campo_especifico' => 23
            ],
            [
            'id' => 70, 
            'titulo' => 'Hotelería, restaurantes y servicios de banquetes',
             'codigo' => '1013',
             'campo_especifico' => 23
            ],
            [
            'id' => 71, 
            'titulo' => 'Deportes',
             'codigo' => '1014',
             'campo_especifico' => 23
            ],
            [
            'id' => 72, 
            'titulo' => 'Viajes, turismo y actividades recreativas',
             'codigo' => '1015',
             'campo_especifico' => 23
            ],
            [
            'id' => 73, 
            'titulo' => 'Saneamiento de la comunidad',
             'codigo' => '1021',
             'campo_especifico' => 24
            ],
            [
            'id' => 74, 
            'titulo' => 'Salud y protección laboral',
             'codigo' => '1022',
             'campo_especifico' => 24
            ],
            [
            'id' => 75, 
            'titulo' => 'Educación militar y de defensa',
             'codigo' => '1031',
             'campo_especifico' => 25
            ],
            [
            'id' => 76, 
            'titulo' => 'Protección de las personas y de la propiedad',
             'codigo' => '1032',
             'campo_especifico' => 25
            ]
        ];

        foreach ($items as $item) {
            \App\CampoDetallado::create($item);
        }
    }
}
