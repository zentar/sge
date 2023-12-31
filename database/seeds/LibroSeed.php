<?php

use Illuminate\Database\Seeder;

class LibroSeed extends Seeder
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
            'titulo' => 'Gestión para la formación en gobernabilidad en el escenario ecuatoriano', 
           // 'autores' => '1',
            'facultad_id' => 3,
          /*  'revision_pares' => '', 
            'contrato' => '',*/
            'isbn' => '-',
            'iepi' => '-', //978-9942-904-62-1,
         /*   'pi' => 'GYE-008607', 
            'paginas' => '128',*/
            'estados_id' => '1',
            'coleccion_id' =>'1',
            'campo_general' =>'1',
            'campo_especifico' =>'1',
            'campo_detallado' =>'1'
           // 'caracteristicas_id' =>'1'       
            ],

            [
            'id' => 2, 
            'titulo' => 'La naturaleza del desvalor productivo crítica a los fundamentos de competencia', 
           // 'autores' => '2;3;4',
            'facultad_id' => 6, 
           /* 'revision_pares' => '',
            'contrato' => '', */
            'isbn' => '-',
            'iepi' => '-',
           /* 'paginas' => '320',*/
            'estados_id' => '1',
            'coleccion_id' =>'1',
            'campo_general' =>'1',
            'campo_especifico' =>'1',
            'campo_detallado' =>'1'
           // 'caracteristicas_id' =>'1'    
    ],
            
            ['id' => 3, 
            'titulo' => 'Student perceptions of the use of SIDWEB for Learning English writing skills in an ecuadorian university', 
           // 'autores' => '6', 
            'facultad_id' => 2,
          /* 'revision_pares' => '',
            'contrato' => '', */
            'isbn' => '-',
            'iepi' => '-',
           /* 'paginas' => '320',*/
            'estados_id' => '1',
            'coleccion_id' =>'1',
            'campo_general' =>'1',
            'campo_especifico' =>'1',
            'campo_detallado' =>'1'
           // 'caracteristicas_id' =>'1'    
            ],

             [
            'id' => 4, 
            'titulo' => 'Problemas sociales de la ciencia, la tecnología y la innovación: Reflexiones sobre el derecho, la educación y la salud humana',
          //  'autores' => '5;7',
            'facultad_id' => 10, 
          /* 'revision_pares' => '',
            'contrato' => '', */
            'isbn' => '-',
            'iepi' => '-',
           /* 'paginas' => '320',*/
            'estados_id' => '1', 
            'coleccion_id' =>'1',
            'campo_general' =>'1',
            'campo_especifico' =>'1',
            'campo_detallado' =>'1'
           // 'caracteristicas_id' =>'1'       
             ]

        ];
      /*  for($i=5;$i<100;$i++){
          array_push($items,['id' => $i, 
          'titulo' => 'Coleccion '.$i,
          'facultad_id' => 10,
          'estados_id' => '2',
          'isbn' => '978-9942-904-62-1',
          'iepi' => '978-9942-904-62-1',
          'coleccion_id' =>'1']);
      }*/
  

        foreach ($items as $item) {
            \App\Libro::create($item);
        }
    }
}
