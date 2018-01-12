<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Book;
use App\Autor;
use App\Capitulos;
use App\Facultad;
use App\Estados;
use App\autorbook;
use App\autorcapitulos;
use App\Coleccion;
use App\Tipodoc;
use App\Caracteristicas;
use DB;

class LibroController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->action('HomeController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autores = Autor::all();
        $facultades = Facultad::all();
        $colecciones = Coleccion::all();
        $autores_nombre=[];
        $facultades_nombre=[];
        array_push($autores_nombre,"Seleccionar Autor"); 
        $facultades_nombre[null] = "Seleccionar Facultad";  

        foreach($autores as $autors){
                    $autores_nombre[$autors->id] = $autors->nombre." ".$autors->apellido;                   
                  }
        foreach($facultades as $facultad){
                    $facultades_nombre[$facultad->id] = $facultad->nombre;                   
                  }        
                 // dd($estados);  
        return view('libros/create/create', compact('libro','autores_nombre','facultades','colecciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data); 
         $rules = array(
        'titulo' => 'required|max:170',
        'facultad_id' => 'required',
        'autor' => 'required',
        'coleccion_id' => 'required'
        );
        if($data['facultad_id']=="null")$data['facultad_id']=null;
        if($data['coleccion_id']=="null")$data['coleccion_id']=null;

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 4)->with('facultad_old', $request->facultad_id);
        }
        else{
              //LIBRO            
              $libro = new Book;            
              $libro->titulo = $data["titulo"];
              $libro->coleccion_id = $data["coleccion_id"];
              $libro->facultad_id = $data["facultad_id"];
              $libro->estados_id = 1;
              $libro->save();

              //CARACTERISTICAS
              $caracteristicas = new Caracteristicas;
              $caracteristicas->book_id = $libro->id;
            /*  $caracteristicas->tamano = $data['tamano'];
              $caracteristicas->tipo_papel = $data['tpapel'];
              $caracteristicas->n_paginas = $data['paginas'];
              $caracteristicas->color = $data['color'];
              $caracteristicas->cubierta = $data['cubierta'];
              $caracteristicas->solapas = $data['solapa'];
              $caracteristicas->observaciones = $data['observaciones'];*/
              $caracteristicas->save();

               foreach($data['autor'] as $autor){  
                 $libroAutor = new autorbook;
                 $libroAutor->book_id=$libro->id;
                 $libroAutor->autor_id=$autor; 
                 $libroAutor->save();
               }

           crearDirectorio('libro',$libro);
           historial('Creación de libro, estado ingresado',$libro->id);      

           Session::flash('message','Registro agregado correctamente');           
           return redirect()->action('HomeController@index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $libro =  Book::with(['cotizacion.file','file.tipodoc','coleccion'])->get()->where('id',$id)->first();
      // dd($libro);    
        return view('libros/consultar/consultar', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //BUSCA EL LIBRO CON ID Y CARGA TAMBIEN LAS RELACIONES 
       $libro =  Book::with(['cotizacion.file','file.tipodoc','coleccion','caracteristicas.tamanopapel'])->get()->where('id',$id)->first();
       //CARGA LOS AUTORES
       $autores = Autor::all();
       //CARGA LAS COLECCIONES
        $colecciones = Coleccion::all();
       // CARGA TODOS LOS TIPOS DE DOCUMENTOS
        $tipos = Tipodoc::all();        
        //BUSCA LOS DOCUMENTOS QUE FALTAN POR INGRESAR
        $doc_no_ingresados = filtrar_documentos_ingresados($libro);        
        $tipos_doc_libro = DB::table('tipodoc')->where([['grupo', '=', 'libro']])->whereNotIn('id', $doc_no_ingresados)->get();        
        
        //CARGA LOS TIPOS DE TAMAÑOS DE PAPEL
        $tamano_papel = \App\TamanoPapel::all();

        //SETEA EL PARAMETRO EDITAR 
        $flag_editar_autor=1;

        
        $autores_nombre=[];
        array_push($autores_nombre,"Seleccionar Autor");  
           foreach($autores as $autors){
                    $autores_nombre[$autors->id] = $autors->nombre." ".$autors->apellido;                   
                  }
        $facultades = Facultad::all();
        $facultades_nombre=[];
        $facultades_nombre[null] = "Seleccionar Facultad";  
        foreach($facultades as $facultad){
                    $facultades_nombre[$facultad->id] = $facultad->nombre;                   
                  }  
       // dd(count($libro->caracteristicas));                 
        return view('libros/editar/editar', compact('libro','autores_nombre','flag_editar_autor','facultades_nombre','colecciones','tipos','tamano_papel','tipos_doc_libro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        //dd($data);

        if($data['tamano']=="null") $data['tamano']=null;
        $rules = array(
           "titulo" => 'max:170',
           "facultad_id" => 'required',
           "autor" => 'required',
           "coleccion_id" => 'required',
           "paginas" =>'numeric|between:1,9999',
           'tamano' =>'required'
        );
         
        $v=Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
              //CARACTERISTICAS
              $caracteristicas = Caracteristicas::get()->where('book_id',$id)->first();
              $caracteristicas->tamano = valorPredeterminado($data['tamano']);
              $caracteristicas->tipo_papel = valorPredeterminado($data['tipo_papel']);
              $caracteristicas->n_paginas = valorPredeterminado($data['paginas']);
              $caracteristicas->color = valorPredeterminado($data['color']);
              $caracteristicas->cubierta = valorPredeterminado($data['cubierta']);
              $caracteristicas->solapas = valorPredeterminado($data['solapa']);
              $caracteristicas->observaciones = valorPredeterminado($data['observaciones']);
            //  dd($caracteristicas);
              $caracteristicas->save();

              

              //LIBRO            
              $libro = Book::find($id);            
              $libro->titulo = $data["titulo"];
              $libro->coleccion_id = $data["coleccion_id"];
              $libro->facultad_id = $data["facultad_id"];

              $libro->isbn = $data['isbn'];
              $libro->iepi = $data['iepi'];
              
              $libro->save();
            
              //ELIMINA RELACION CON AUTORES CARACTERISTICAS
              $eliminar = autorbook::where('book_id', $libro->id);
              if(!$eliminar==null)
              $eliminar->delete();  

        //CREA RELACIONES NUEVAS DE LIBROS CON AUTORES
        foreach($data['autor'] as $autor){  
            $libroAutor = new autorbook;
            $libroAutor->book_id=$libro->id;
            $libroAutor->autor_id=$autor; 
            $libroAutor->save();
           }
           
            Session::flash('message','Registro editado correctamente');
            return redirect()->action('HomeController@index'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libro = Book::find($id);
        $libro_autor =  autorbook::all()->where('book_id',$id);
        if(empty($libro))
        {
            Session::flash('message','Registro no encontrado');
            return redirect(route('admin.home'));
        }else{
            $libro->delete();
            foreach($libro_autor as $relacion){
              $relacion->delete();
            }
            
            Session::flash('message','Registro borrado sin problemas.');
            return redirect(route('admin.home')); 
        }
       
    }

    public function capitulos(Request $request,$id)
    {
        $libro = Book::find($id);     
        $autores = Autor::all();  
        return view('libros/capitulos', compact('libro','autores'));
    }

    public function agregarCapitulos(Request $request){
         $data = $request->all();
        // dd($data);
          $rules = array(
           "titulo" => 'required' 
        );

       if($data['descripcion']==null)$data['descripcion']='-';
       
        $v=Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
         //PIPO
         if(isset($data['capitulo_edit'])){
             $capitulo = capitulos::where('id',$data['capitulo_edit'])->first();             
              $capitulo->titulo = $data["titulo"];
              $capitulo->descripcion = $data["descripcion"];             
              $capitulo->save();
              $borrar_capitulos = autorcapitulos::get()->where('capitulos_id',$data['capitulo_edit']);
             // dd($borrar_capitulos);
              if(count($borrar_capitulos)>0){  
                 foreach($borrar_capitulos as $borrar)  
                 $borrar->delete();        
              }

              foreach($data["autor"] as $autor){ 
                 if($autor != null){   
                 $autorcapitulos = new autorcapitulos();
                 $autorcapitulos->capitulos_id = $capitulo->id;
                 $autorcapitulos->autor_id = $autor; 
                 // dd($autorcapitulos);
                 $autorcapitulos->save();
               }
              }   

         }else{
              $capitulo = new capitulos();
              $capitulo->book_id = $data["libro_id"];
              $capitulo->titulo = $data["titulo"];
              $capitulo->descripcion = $data["descripcion"];
              $capitulo->save();

              foreach($data["autor"] as $autor){ 
                 if($autor != null){   
                 $autorcapitulos = new autorcapitulos();
                 $autorcapitulos->capitulos_id = $capitulo->id;
                 $autorcapitulos->autor_id = $autor; 
                 $autorcapitulos->save();
               }
              }
            }
     
      Session::flash('message','Capitulo ingresado sin problemas.');
    //  return redirect()->action('LibroController@edit', ['id' => $data['libro_id']]);
       return redirect()->back()->withInput();
    }

    public function eliminarCapitulos(Request $request,$id){
      $autorcapitulos = autorcapitulos::get()->where('capitulos_id',$id);
       foreach($autorcapitulos as $borrar_relacion){   
                   $borrar_relacion->delete();  
               }    
      $existe_capitulos = capitulos::get()->where('id',$id);
      foreach($existe_capitulos as $borrar){ 
        $borrar->delete();
    }
      Session::flash('message','Capitulo eliminado sin problemas.');
      return redirect()->back()->withInput();
    }

    public function editarDocumentos(Request $request, $id)
    {
      $tipos = Tipodoc::get()->where('grupo','libro');
      $libro = Book::find($id);
      return view('libros/documentos', compact('tipos','libro'));
    }

    public function agregarCotizacion(Request $request, $id)
    {
       $libro = Book::find($id);
      return view('libros/cotizacion', compact('tipos','libro'));
    }

    public function editarCotizacion(Request $request, $id)
    {
      $libro = Book::with('cotizacion.file')->get()->where('id',$id)->first(); 
     // dd($libro);
     return view('libros/cotizacion', compact('tipos','libro'));
    }

    public function reporteCotizacion(Request $request, $id,$tipo)
    {       
          $cotizaciones = \App\Cotizacion::get()->where('book_id',$id);
          $libro = Book::find($id);
          if(count($cotizaciones)>0){
            if($tipo=="docx"){         
             $tipoLetra = "Cambria (Títulos)";         
          //PRUEBA CREACION WORD DOC          
          $phpWord = new \PhpOffice\PhpWord\PhpWord();

           //COLOCA EL DOCUMENTO EN ESPAÑOL
           $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));
           
           //MARGENES DE LA PAGINA EN twip
           $section = $phpWord->addSection(array('marginLeft' => 2267.716535433, 'marginRight' => 1700.787401575,
           'marginTop' => 1984.251968504, 'marginBottom' => 1315.275590551));

           // Add header
           $header = $section->createHeader();
           $table = $header->addTable();
           $table->addRow();
           $table->addCell(5000)->addImage('logoNormal.png', array('width'=>160, 'height'=>45, 'align'=>'left'));
           $table->addCell(5000)->addImage('logoUCSG.png', array('width'=>113, 'height'=>56, 'align'=>'right'));
   
           
           // Add footer
           $footer = $section->createFooter();
           $footer->addLine(['weight' => 1, 'width' => 415, 'height' => 0]);
           $footer->addPreserveText('Av .C.J. Arosemena Km. 1,5 Edificio principal, segundo piso. Apartado postal 09-01-4671 Guayaquil – Ecuador
           Telefax: 593-04-2209210 Ext. 2634 Correo electrónico: roberto.garcia02@cu.ucsg.edu.ec
           ', array('name' => 'Arial Narrow', 'size' => 9), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);


           // CONSIGUE LA FECHA DE HOY EN ESPAÑOL PARA EL ENCABEZADO
           setlocale(LC_TIME, "es_ES", 'Spanish_Spain', 'Spanish');
           $fecha_hoy = \Carbon\Carbon::now();
           $mes = iconv('ISO-8859-2', 'UTF-8', strftime("%B de %Y", strtotime($fecha_hoy)));
           $fecha = iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($fecha_hoy)));

           $section->addText('No. 001 ',array('bold'=>true,'name' => $tipoLetra, 'size' => 10), ['align'=>'right','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $section->addText('Guayaquil, '.$fecha,array('name' => $tipoLetra, 'size' => 10), ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $section->addText('PRODUCCIÓN DE LA OBRA: ', array('name' => $tipoLetra, 'size' => 10,'bold'=>true), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $section->addText($libro->titulo, array('name' => $tipoLetra, 'size' => 10,'bold'=>true), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $section->addText('Cotización solicitada, en mes de '.$mes.', de acuerdo con las siguientes características:', array('name' => $tipoLetra, 'size' => 10), [ 'align' => 'both' ]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           
           $titulo = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $titulo->addText('Título: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $titulo->addText($libro->titulo,array('name' => $tipoLetra, 'size' => 10));

           $autores = "";

           foreach($libro->autor as $autor){
            $autores .= $autor->nombre." ".$autor->apellido;
            if($autor == $libro->autor->last())
                $autores .="."; 
            else
            $autores .=", "; 
           }
           $autor = $autores;
           $tipo_papel = \App\TamanoPapel::find($libro->caracteristicas->tamano)->descripcion;
        
           //dd($libro->caracteristicas);
           $autores = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $autores->addText('Autores: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $autores->addText($autor,array('name' => $tipoLetra, 'size' => 10));

           $tamano = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $tamano->addText('Tamaño: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $tamano->addText($tipo_papel,array('name' => $tipoLetra, 'size' => 10));

           $papel = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $papel->addText('Papel: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $papel->addText($libro->caracteristicas->tipo_papel,array('name' => $tipoLetra, 'size' => 10));

           $paginas = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $paginas->addText('Número de páginas: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $paginas->addText($libro->caracteristicas->n_paginas,array('name' => $tipoLetra, 'size' => 10));

           $cubierta = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $cubierta->addText('Cubierta: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $cubierta->addText($libro->caracteristicas->cubierta,array('name' => $tipoLetra, 'size' => 10));

           $solapas = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $solapas->addText('Solapas: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $solapas->addText($libro->caracteristicas->solapas,array('name' => $tipoLetra, 'size' => 10));

           $tiraje = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $tiraje->addText('Tiraje: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $tiraje->addText('-',array('name' => $tipoLetra, 'size' => 10));

           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
         //  $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);

           $header = array('size' => 16, 'bold' => true,'alignment'=>'both');
         //  $section->addText('Cotizaciones', $header, [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);

           $phpWord->addTableStyle('Estilo Cotizacion', array('borderSize' => 6, 'borderColor' => '#000000', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));

           $table = $section->addTable('Estilo Cotizacion');
           $i=1;
           foreach($cotizaciones as $cotizacion){          
           $table->addRow();
           $table->addCell(5000)->addText("Empresa calificada: ".$cotizacion->imprenta,array('bold'=>true,'name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0 ]);
           $table->addCell(5000)->addText(null,array('name' => $tipoLetra, 'size' => 10),  [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
           
           $table->addRow();
           $table->addCell(5000)->addText($cotizacion->tiraje." ejemplares",array('name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
           $table->addCell(5000)->addText($cotizacion->valor, array('name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
           $i++;
           }
           

           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);           
           $section->addText('Observaciones:', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);

           $section->addText('Considerando la calidad del material, tiempo de entrega, acabados, se selecciona a la Empresa _________________________________________',array('name' => $tipoLetra, 'size' => 10));
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $section->addText('Tramitado por:    			Vto. Bno.			Autorizado',array('name' => $tipoLetra, 'size' => 10),['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $section->addText('_____________			      _________________		          ________________',array('name' => $tipoLetra, 'size' => 10));
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
           $section->addText('Se adjunta (5) copia(s) de cotizaciones.',array('name' => $tipoLetra, 'size' => 10));
           $section->addText('SO. Trabajo #..........',array('name' => $tipoLetra, 'size' => 10));
           


           $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
           $objWriter->save('ReporteCotizacion.docx');       
               
        
         return response()->download('ReporteCotizacion.docx', 'ReporteCotizacion.docx');
        }else{
            if($tipo=="pdf"){
           $pdf = \PDF::loadView('prueba',['cotizaciones'=>$cotizaciones]);
            return $pdf->download('ReporteCotizacion.pdf'); 
           // dd($cotizaciones);
            }else{
                \Excel::create('New file', function($excel)  use ($cotizaciones) {

                    $excel->sheet('New sheet', function($sheet) use ($cotizaciones) {
                
                        $sheet->loadView('prueba',array('cotizaciones'=>$cotizaciones));
                
                    });
                
                })->download('xlsx');
            }       
         }   
        
        }else{
           
            abort(404);
        }
    }
}
