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
        //VARIABLE QUE CONTROLA EL FORMULARIO EN QUE SE ENCUENTRA PARA LA GENERACION DE LOS AUTORES
        $nuevo = 1 ;
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
        return view('libros/create/create', compact('libro','autores_nombre','facultades','colecciones','nuevo'));
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
        //VARIABLE QUE CONTROLA EL FORMULARIO EN QUE SE ENCUENTRA PARA LA GENERACION DE LOS AUTORES
        $nuevo = 0 ; 
        //BUSCA EL LIBRO CON ID Y CARGA TAMBIEN LAS RELACIONES 
        $libro =  Book::with(['cotizacion.file','file.tipodoc','coleccion','caracteristicas.tamanopapel','caracteristicas.tipopapel','caracteristicas.colorpapel'])->get()->where('id',$id)->first();
        //CARGA LOS AUTORES
        $autores = Autor::all();
        //CARGA LAS COLECCIONES
         $colecciones = Coleccion::all();
        // CARGA TODOS LOS TIPOS DE DOCUMENTOS
         $tipos = Tipodoc::all();    
         //CARGA LOS TIPOS DE PAPEL
         $tipos_papel = \App\TipoPapel::all(); 
         //CARGA LOS TIPOS DE COLOR
         $tipos_color = \App\ColorPapel::all();
         //BUSCA LOS DOCUMENTOS QUE FALTAN POR INGRESAR
        $doc_no_ingresados = filtrar_documentos_ingresados($libro);        
        $tipos_doc_libro = DB::table('tipodoc')->where([['grupo', '=', 'libro']])->whereNotIn('id', $doc_no_ingresados)->get();        
        //CARGA LOS TIPOS DE TAMAÑOS DE PAPEL
        $tamano_papel = \App\TamanoPapel::all();
        //SETEA EL PARAMETRO EDITAR 
        $flag_editar_autor=1;

        //dd($libro->caracteristicas);

        //COMPRUEBA QUE LOS REGISTROS DE LOS DOCUMENTOS PERTENECIENTES AL ISBN O IEPI RESPECTIVAMENTE EXISTAN
        $flag_ISBN = permisos_isbn_iepi($libro,"isbn");
        $flag_IEPI = permisos_isbn_iepi($libro,"iepi");
        
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

              
       // dd(count($isbn_iepi));                 
        return view('libros/editar/editar', compact('libro','autores_nombre','flag_editar_autor','facultades_nombre','colecciones','tipos','tamano_papel','tipos_doc_libro','nuevo','flag_ISBN','flag_IEPI','tipos_papel','tipos_color'));
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
       // dd($data);

        if($data['tamano']=="null") $data['tamano']=null;
        if($data['tipopapel']=="null") $data['tipopapel']=null;
        if($data['colorpapel']=="null") $data['colorpapel']=null;

        $rules = array(
           "titulo" => 'max:170',
           "facultad_id" => 'required',
           "autor" => 'required',
           "coleccion_id" => 'required',
           "paginas" =>'numeric|between:1,9999',
           'tamano' =>'required',
           'tipopapel' =>'required',
           'colorpapel' =>'required'
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
              $caracteristicas->tipopapel_id = valorPredeterminado($data['tipopapel']);
              $caracteristicas->n_paginas = valorPredeterminado($data['paginas']);
              $caracteristicas->colorpapel_id = valorPredeterminado($data['colorpapel']);
              $caracteristicas->cubierta = valorPredeterminado($data['cubierta']);
              $caracteristicas->solapas = valorPredeterminado($data['solapa']);
              $caracteristicas->observaciones = valorPredeterminado($data['observaciones']);
              //dd($caracteristicas);
              $caracteristicas->save();              

              //LIBRO            
              $libro = Book::find($id);            
              $libro->titulo = $data["titulo"];
              $libro->coleccion_id = $data["coleccion_id"];
              $libro->facultad_id = $data["facultad_id"];
              
              if(isset($data['isbn'])) $libro->isbn = $data['isbn'];
              if(isset($data['iepi'])) $libro->iepi = $data['iepi'];
             
           
              
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
              return reporte_cotizacion($libro,$cotizaciones);
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
