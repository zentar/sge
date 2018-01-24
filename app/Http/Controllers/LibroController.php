<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
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
use Mail;

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
        if (! Gate::allows('libro_create')) {
            return abort(403);
        }

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
        if (! Gate::allows('libro_create')) {
            return abort(403);
        }

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
        if (! Gate::allows('libro_view')) {
            return abort(403);
        }

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
        if (! Gate::allows('libro_edit')) {
            return abort(403);
        }

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
        
        //BUSCA LOS EDITORES PARA SU ASIGNACION
        if($libro->asignado == 0 && $libro->estados_id == 2)
        //SI EL EDITOR NO HA SIDO ASIGNADO, BUSCA TODOS LOS USUARIOS QUE SON EDITORES
        $editores = \App\User::where('role_id',4)->get();
        else
        //SI EL EDITOR YA FUE ASIGNADO, LO BUSCA Y DEVUELVE SU NOMBRE
        if(isset($libro->user[0]->name))
        $editores = $libro->user[0]->name;

        //BUSCA LOS GESTORES DE PRODUCCION PARA SU ASIGNACION
        if($libro->asignado == 0 && $libro->estados_id == 4)
        //SI EL GP NO HA SIDO ASIGNADO, BUSCA TODOS LOS USUARIOS QUE SON GP
        $gestor_p = \App\User::where('role_id',3)->get();
        else    
        $gestor_p = "";

     //   dd($gestor_p);

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
    
        foreach($facultades as $facultad){
                    $facultades_nombre[$facultad->id] = $facultad->nombre;                   
                  }  

              
        //dd($libro->coleccion->titulo);                 
        return view('libros/editar/editar', compact('libro','autores_nombre','flag_editar_autor','facultades_nombre','colecciones','tipos','tamano_papel','tipos_doc_libro','nuevo','flag_ISBN','flag_IEPI','tipos_papel','tipos_color','editores','gestor_p'));
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

        if (! Gate::allows('libro_edit')) {
            return abort(403);
        }        
     
        $data = $request->all();
       // dd($data);
        $rules = array(
           "titulo" => 'max:170',
           "autor" => 'required',
           "paginas" =>'numeric|between:1,9999'
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
          if(isset($data['tamano']))         $caracteristicas->tamano = valorPredeterminado($data['tamano']);
          if(isset($data['tipopapel']))      $caracteristicas->tipopapel_id = valorPredeterminado($data['tipopapel']);
          if(isset($data['paginas']))        $caracteristicas->n_paginas = valorPredeterminado($data['paginas']);
          if(isset($data['colorpapel']))     $caracteristicas->colorpapel_id = valorPredeterminado($data['colorpapel']);
          if(isset($data['cubierta']))       $caracteristicas->cubierta = valorPredeterminado($data['cubierta']);
          if(isset($data['solapa']))         $caracteristicas->solapas = valorPredeterminado($data['solapa']);
          if(isset($data['observaciones']))  $caracteristicas->observaciones = valorPredeterminado($data['observaciones']);
              $caracteristicas->save();              

              //LIBRO            
              $libro = Book::find($id);            
          if(isset($data["titulo"]))          $libro->titulo = $data["titulo"];
          if(isset($data["coleccion_id"]))    $libro->coleccion_id = $data["coleccion_id"];
          if(isset($data["facultad_id"]))     $libro->facultad_id = $data["facultad_id"];
              
              if(isset($data['ISBN'])) $libro->isbn = $data['ISBN'];
              if(isset($data['IEPI'])) $libro->iepi = $data['IEPI'];

         
              
              $libro->save();


             if($libro->estados_id == 6 && isset($libro->isbn) && isset($libro->iepi)){
                $libro->estados_id =7;            
                $libro->save();
                historial('Se subieron documentos ISBN - IEPI - Estado Publicado',$libro->id); 
              }
           
            
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
        if (! Gate::allows('libro_delete')) {
            return abort(403);
        }

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
         if(isset($data['capitulo_edit'])){
             $capitulo = capitulos::where('id',$data['capitulo_edit'])->first();             
              $capitulo->titulo = $data["titulo"];
              $capitulo->descripcion = $data["descripcion"];             
              $capitulo->save();
              $borrar_capitulos = autorcapitulos::get()->where('capitulos_id',$data['capitulo_edit']);
              if(count($borrar_capitulos)>0){  
                 foreach($borrar_capitulos as $borrar)  
                 $borrar->delete();        
              }

              foreach($data["autor"] as $autor){ 
                 if($autor != null){   
                 $autorcapitulos = new autorcapitulos();
                 $autorcapitulos->capitulos_id = $capitulo->id;
                 $autorcapitulos->autor_id = $autor;       
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
            setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
            $fecha =iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B del %Y", strtotime(\Carbon\Carbon::now())));
     
           $pdf = \PDF::loadView('reportes/ReporteCotizacion',['libro'=>$libro,'cotizaciones'=>$cotizaciones,'fecha'=>$fecha]);
            return $pdf->download('ReporteCotizacion.pdf'); 
            }else{
                \Excel::create('New file', function($excel)  use ($cotizaciones) {
                    $excel->sheet('New sheet', function($sheet) use ($cotizaciones) {                
                        $sheet->loadView('reportes/ReporteCotizacion',array('cotizaciones'=>$cotizaciones));                
                    });                
                })->download('xlsx');
            }       
         } 

        }else{           
            abort(404);
        }
    }

    public function asignar(Request $request){
        try{
            $data = $request->all();
            //dd($data);   
       if($data['tipo']=="edicion"){
        $asignacion = new \App\userbook();
        $asignacion->book_id = $data['libro_id'];
        $asignacion->user_id = $data['editor_id'];
        $asignacion->tipo = $data['tipo'];
        $asignacion->estado = 1; 
        $asignacion->save();

      $user = \App\User::findOrFail($data['editor_id']);
      $libro = \App\Book::find($data['libro_id']);


      Mail::send('mails.avisoEditor', ['user' => $user,'libro'=>$libro], function ($m) use ($user) {
          $m->from('ceid1994@gmail.com', 'Sistema de Gestion Editorial UCSG');

          $m->to($user->email, $user->name)->subject('Asignacion de Libro - Edición');
      });
      
      $libro->estados_id = 3;
      $libro->asignado = 1;
      $libro->save();
      
      historial('El administrador '.\Auth::User()->name.' asigno al editor '.$user->name.', estado edición',$libro->id); 
      Session::flash('message','Editor Asignado sin problemas.');
      return redirect()->back()->withInput();


      }elseif($data['tipo']=="cotizacion"){ 

        $asignacion = new \App\userbook();
        $asignacion->book_id = $data['libro_id'];
        $asignacion->user_id = $data['gp_id'];
        $asignacion->tipo = $data['tipo'];
        $asignacion->estado = 1; 
        $asignacion->save();

      $user = \App\User::findOrFail($data['gp_id']);
      $libro = \App\Book::find($data['libro_id']);


      Mail::send('mails.avisoCotizador', ['user' => $user,'libro'=>$libro], function ($m) use ($user) {
          $m->from('ceid1994@gmail.com', 'Sistema de Gestion Editorial UCSG');

          $m->to($user->email, $user->name)->subject('Asignacion para Cotización de Libro');
      });
      
      $libro->estados_id = 5;
      $libro->asignado = 1;
      $libro->save();
      historial('El administrador '.\Auth::User()->name.' asigno al cotizador '.$user->name.', estado Aprobado Cotización',$libro->id); 

      Session::flash('message','Gestor de Producción Asignado sin problemas.');
      return redirect()->back()->withInput();      
      
        }
        }catch(\Exception $e){
            return $e->getMessage();
        }
      
    }

    public function cierreEdicion(Request $request){
    try{
        $data = $request->all();
        $libro = \App\Book::find($data['libro_id']);
        
        $asignacion = \App\userbook::where('book_id',$data['libro_id'])->where('tipo','edicion')->first();
        $asignacion->estado=0; 
        $asignacion->save();

        $libro->estados_id = 4;

        $libro->asignado = 0;
       
        $libro->save();

        historial('El editor realizo el cierre de la edición, estado Cotización',$libro->id);

        Session::flash('message','Edición cerrado sin problemas.');
        return redirect()->action('HomeController@index');
  
    }catch(\Exception $e){
        return $e->getMessage();
    }

    }

}
