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
            'autores' => '1',
            'facultad' => 'Economía',
            'revision_pares' => '', 
            'contrato' => '',
            'isbn' => '978-9942-904-62-1',
            'pi' => 'GYE-008607', 
            'paginas' => '128'
            ],

            [
            'id' => 2, 
            'titulo' => 'La naturaleza del desvalor productivo crítica a los fundamentos de competencia', 
            'autores' => '2;3;4',
            'facultad' => 'Especialidades Empresariales', 
            'revision_pares' => '',
            'contrato' => '', 
            'isbn' => '978-9942-904-75-1', 
            'pi' => 'GYE-008647',
            'paginas' => '320'],
            
            ['id' => 3, 
            'titulo' => 'Student perceptions of the use of SIDWEB for Learning English writing skills in an ecuadorian university', 
            'autores' => '6', 
            'facultad' => 'Artes y Humanidades',
            'revision_pares' => '', 
            'contrato' => '',
            'isbn' => '978-9942-904-97-3',
            'pi' => '',
            'paginas' => '96'],

             [
            'id' => 4, 
            'titulo' => 'Problemas sociales de la ciencia, la tecnología y la innovación: Reflexiones sobre el derecho, la educación y la salud humana',
            'autores' => '5;7',
            'facultad' => 'Aspirantes a doctorado', 
            'revision_pares' => '', 
            'contrato' => '', 
            'isbn' => '978-9942-769-02-2',
            'pi' => '', 
            'paginas' => '106'
             ]


        ];

        foreach ($items as $item) {
            \App\Book::create($item);
        }
    }
}
