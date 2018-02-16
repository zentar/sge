<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Libro;
use App\Autor;
use App\Capitulos;
use App\Facultad;
use App\Estados;
use App\autorlibro;
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
        $autores = Autor::orderBy('nombre', 'asc')->get();
        $facultades = Facultad::orderBy('nombre', 'asc')->get();
        $colecciones = Coleccion::orderBy('titulo', 'asc')->get();
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
              $libro = new Libro;            
              $libro->titulo = $data["titulo"];
              $libro->coleccion_id = $data["coleccion_id"];
              $libro->facultad_id = $data["facultad_id"];

              //ESTADO INGRESADO 
              $libro->estados_id = 1;
              $libro->save();

              //CARACTERISTICAS
              $caracteristicas = new Caracteristicas;
              $caracteristicas->libro_id = $libro->id;
              $caracteristicas->save();

               foreach($data['autor'] as $autor){  
                 $libroAutor = new autorlibro;
                 $libroAutor->libro_id=$libro->id;
                 $libroAutor->autor_id=$autor; 
                 $libroAutor->save();
               }

           crearDirectorio('libro',$libro);

           historial(\Auth::User()->name.' con id '.\Auth::User()->id.' y rol '.\Auth::User()->role->title.' ha creado este libro, Estado:Ingresado',$libro->id);      

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

        $libro =  Libro::with(['cotizacion.archivo','archivo.tipodoc','coleccion'])->get()->where('id',$id)->first();
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
        $libro =  Libro::with(['cotizacion.archivo','archivo.tipodoc','coleccion','caracteristicas.tamanopapel','caracteristicas.tipopapel','caracteristicas.colorpapel','mensajes.archivo','mensajes.user'])->get()->where('id',$id)->first();
        //CARGA LOS AUTORES
        $autores = Autor::orderBy('nombre', 'asc')->get();
        //CARGA LAS COLECCIONES
         $colecciones = Coleccion::orderBy('titulo', 'asc')->get();
        // CARGA TODOS LOS TIPOS DE DOCUMENTOS
         $tipos = Tipodoc::orderBy('nombre', 'asc')->get();    
         //CARGA LOS TIPOS DE PAPEL
         $tipos_papel = \App\TipoPapel::orderBy('descripcion', 'asc')->get(); 
         //CARGA LOS TIPOS DE COLOR
         $tipos_color = \App\ColorPapel::orderBy('descripcion', 'asc')->get();
         //BUSCA LOS DOCUMENTOS QUE FALTAN POR INGRESAR
          $doc_no_ingresados = filtrar_documentos_ingresados($libro); 
         // dd($libro->campogeneral,$libro->campoespecifico,$libro->campodetallado);
        
         $campo_general = \App\CampoGeneral::all();
         $campo_especifico = \App\CampoEspecifico::all();
         $campo_detallado = \App\CampoDetallado::all();;


        if($libro->estados_id < 6){ array_push($doc_no_ingresados,19);}
        if(\Auth::User()->id == 1 || \Auth::User()->id == 2 || \Auth::User()->id == 3)
        $tipos_doc_libro = DB::table('tipodoc')->where([['grupo', '=', 'libro']])->whereNotIn('id', $doc_no_ingresados)->orderBy('nombre', 'asc')->get();        
        if(\Auth::User()->id == 4)
        $tipos_doc_libro = \App\Tipodoc::where([['nombre', '=', 'Contenido'],['grupo', '=', 'libro']])->orWhere([['nombre', '=', 'Cubierta'],['grupo', '=', 'libro']])->orWhere([['nombre', '=', 'Revisión de Pares'],['grupo', '=', 'libro']])->orderBy('nombre', 'asc')->get();        
        
       // dd(\Auth::User()->id,$tipos_doc_libro);
        //CARGA LOS TIPOS DE TAMAÑOS DE PAPEL
        $tamano_papel = \App\TamanoPapel::orderBy('descripcion', 'asc')->get();
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

        //COMPRUEBA QUE LOS REGISTROS DE LOS DOCUMENTOS PERTENECIENTES AL ISBN O IEPI RESPECTIVAMENTE EXISTAN
        $flag_ISBN = permisos_isbn_iepi($libro,"isbn");
        $flag_IEPI = permisos_isbn_iepi($libro,"iepi");
        
        $autores_nombre=[];
        array_push($autores_nombre,"Seleccionar Autor");  
           foreach($autores as $autors){
                    $autores_nombre[$autors->id] = $autors->nombre." ".$autors->apellido;                   
                  }
        $facultades = Facultad::orderBy('nombre', 'asc')->get();
        $facultades_nombre=[];
    
        foreach($facultades as $facultad){
                    $facultades_nombre[$facultad->id] = $facultad->nombre;                   
                  }  

        //dd($libro->coleccion->titulo);                 
        return view('libros/editar/editar', compact('libro','autores_nombre','flag_editar_autor','facultades_nombre','colecciones','tipos','tamano_papel','tipos_doc_libro','nuevo','flag_ISBN','flag_IEPI','tipos_papel','tipos_color','editores','gestor_p','campo_general','campo_especifico','campo_detallado'));
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
           "paginas" =>'numeric|between:1,9999',
           'libro_original'=>'mimes:jpeg,bmp,png,pdf,doc,docx,xlsx|max:20480'
        );
         
        $v=Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
          //  dd($data);
              //CARACTERISTICAS
          $caracteristicas = Caracteristicas::get()->where('libro_id',$id)->first();
          if(isset($data['tamano']))         $caracteristicas->tamano = valorPredeterminado($data['tamano']);
          if(isset($data['tipopapel']))      $caracteristicas->tipopapel_id = valorPredeterminado($data['tipopapel']);
          if(isset($data['paginas']))        $caracteristicas->n_paginas = valorPredeterminado($data['paginas']);
          if(isset($data['colorpapel']))     $caracteristicas->colorpapel_id = valorPredeterminado($data['colorpapel']);
          if(isset($data['cubierta']))       $caracteristicas->cubierta = valorPredeterminado($data['cubierta']);
          if(isset($data['solapa']))         $caracteristicas->solapas = valorPredeterminado($data['solapa']);
          if(isset($data['observaciones']))  $caracteristicas->observaciones = valorPredeterminado($data['observaciones']);
              $caracteristicas->save();              

              //LIBRO            
              $libro = Libro::find($id);            
          if(isset($data["titulo"]))          $libro->titulo = $data["titulo"];
          if(isset($data["coleccion_id"]))    $libro->coleccion_id = $data["coleccion_id"];
          if(isset($data["facultad_id"]))     $libro->facultad_id = $data["facultad_id"];

          if(isset($data["campo_general_id"]))       $libro->campo_general = $data["campo_general_id"];
          if(isset($data["campo_especifico_id"]))    $libro->campo_especifico = $data["campo_especifico_id"];
          if(isset($data["campo_detallado_id"]))     $libro->campo_detallado = $data["campo_detallado_id"];
              
              if(isset($data['ISBN'])) $libro->isbn = $data['ISBN'];
              if(isset($data['IEPI'])) $libro->iepi = $data['IEPI'];
              
              
              $eliminar_original = $libro->archivo()->where('tipodoc_id', 20)->first();
          
              if($eliminar_original != null && isset($data['libro_original']) && $data['libro_original'] != null ){

               $relacion = \App\archivolibro::where('archivo_id', $eliminar_original->id)->where('libro_id', 1)->first();
               $relacion->forceDelete(); 

               $eliminar_original->forceDelete(); 
               Storage::delete($eliminar_original->ruta);
            
              }

              if(isset($data['libro_original']) && $data['libro_original'] != null)
           {
             //CREA UN NUEVO FILE Y LE ASIGNA LOS VALORES
           $file = new \App\Archivo;
           $archivo = $data['libro_original'];
           $file->tipodoc_id = 20; 
           $file->nombre = $archivo->getClientOriginalName();
           $file->nombre_subida = $archivo->getClientOriginalName();
           $file->extension = $archivo->extension();
           $file->peso = $archivo->getClientSize();
           $file->observaciones = "Archivo original guardado automaticamente";

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/libros/libro'.$libro->id,$archivo);           
           $file->ruta = $path;
           $file->save();
           $libro_doc = new \App\archivolibro;
           $libro_doc->libro_id = $libro->id;
           $libro_doc->archivo_id = $file->id;
           $libro_doc->save();          
           }

              $libro->save();


              
            
              //ELIMINA RELACION CON AUTORES CARACTERISTICAS
              $eliminar = autorlibro::where('libro_id', $libro->id);
              if(!$eliminar==null)
              $eliminar->forceDelete();  

        //CREA RELACIONES NUEVAS DE LIBROS CON AUTORES
        foreach($data['autor'] as $autor){  
            $libroAutor = new autorlibro;
            $libroAutor->libro_id=$libro->id;
            $libroAutor->autor_id=$autor; 
            $libroAutor->save();
           }
           
            Session::flash('message','Registro editado correctamente');
            return redirect()->back(); 
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

        $libro = Libro::find($id);
        $libro_autor =  autorlibro::all()->where('libro_id',$id);
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
        $libro = Libro::find($id);     
        $autores = Autor::orderBy('nombre', 'asc')->get();  
        return view('libros/capitulos', compact('libro','autores'));
    }

    public function agregarCapitulos(Request $request){
         $data = $request->all();
         //dd($data);
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
                 $borrar->forceDelete();        
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
              $capitulo->libro_id = $data["libro_id"];
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
      $libro = Libro::find($id);
      return view('libros/documentos', compact('tipos','libro'));
    }

    public function agregarCotizacion(Request $request, $id)
    {
       $libro = Libro::find($id);
      return view('libros/cotizacion', compact('tipos','libro'));
    }

    public function editarCotizacion(Request $request, $id)
    {
      $libro = Libro::with('cotizacion.file')->get()->where('id',$id)->first(); 
     // dd($libro);
     return view('libros/cotizacion', compact('tipos','libro'));
    }

    public function reporteCotizacion(Request $request, $id,$tipo)
    {       
          $cotizaciones = \App\Cotizacion::get()->where('libro_id',$id);
          $libro = Libro::find($id);
          if(count($cotizaciones)>0){
            if($tipo=="docx"){         
              return reporte_cotizacion($libro,$cotizaciones);
        }else{
            if($tipo=="pdf"){
            setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
            $fecha =iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B del %Y", strtotime(\Carbon\Carbon::now())));
     
           $pdf = \PDF::loadView('reportes/ReporteCotizacion',['libro'=>$libro,'cotizaciones'=>$cotizaciones,'fecha'=>$fecha]);
            return $pdf->download('ReporteCotizacion.pdf'); 
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
        $asignacion = new \App\userlibro();
        $asignacion->libro_id = $data['libro_id'];
        $asignacion->user_id = $data['editor_id'];
        $asignacion->tipo = $data['tipo'];
        $asignacion->estado = 1; 
        $asignacion->save();

      $user = \App\User::findOrFail($data['editor_id']);
      $libro = \App\Libro::find($data['libro_id']);


      Mail::send('mails.avisoEditor', ['user' => $user,'libro'=>$libro], function ($m) use ($user) {
          $m->from('ceid1994@gmail.com', 'Sistema de Gestion Editorial UCSG');

          $m->to($user->email, $user->name)->subject('Asignacion de Libro - Edición');
      });
      
      //ESTADO EDICION
      $libro->estados_id = 3;
      $libro->asignado = 1;
      $libro->save();
      
      historial(\Auth::User()->name.' con id '.\Auth::User()->id.' y rol '.\Auth::User()->role->title.' asignó al editor '.$user->name.', Estado:Edición',$libro->id); 
      Session::flash('message','Editor Asignado sin problemas.');
      return redirect()->back()->withInput();


      }elseif($data['tipo']=="cotizacion"){ 

        $asignacion = new \App\userlibro();
        $asignacion->libro_id = $data['libro_id'];
        $asignacion->user_id = $data['gp_id'];
        $asignacion->tipo = $data['tipo'];
        $asignacion->estado = 1; 
        $asignacion->save();

      $user = \App\User::findOrFail($data['gp_id']);
      $libro = \App\Libro::find($data['libro_id']);


      Mail::send('mails.avisoCotizador', ['user' => $user,'libro'=>$libro], function ($m) use ($user) {
          $m->from('ceid1994@gmail.com', 'Sistema de Gestión Editorial UCSG');

          $m->to($user->email, $user->name)->subject('Asignación para Cotización de Libro');
      });
      
      $libro->asignado = 1;
      $libro->save();
     
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
        $libro = \App\Libro::find($data['libro_id']);
        
        if($libro->caracteristicas->n_paginas !=1 && $libro->caracteristicas->cubierta != "-" && $libro->caracteristicas->solapas !="-"){
        $asignacion = \App\userlibro::where('libro_id',$data['libro_id'])->where('tipo','edicion')->first();
        $asignacion->estado=0; 
        $asignacion->save();

        //ESTADO COTIZACION
        $libro->estados_id = 4;

        $libro->asignado = 0;
       
        $libro->save();

        historial(\Auth::User()->name.' con id '.\Auth::User()->id.' y rol '.\Auth::User()->role->title.' realizó el cierre de la edición, Estado:Cotización',$libro->id);

        Session::flash('message','Edición cerrado sin problemas.');
       }
       else{
           Session::flash('warning','Para cerrar la edición necesita tener ingresado todas las caracteristicas.'); 
       }

        return redirect()->back();
  
    }catch(\Exception $e){
        return $e->getMessage();
    }

    }

    public function solicitudAprobacion($id){
        $libro = Libro::find($id);
        $solicitud = new  \PhpOffice\PhpWord\TemplateProcessor('SolicitudAprobacion.docx');
        setlocale(LC_TIME, "es_ES", 'Spanish_Spain', 'Spanish');
        $fecha_guardado = iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime(\Carbon\Carbon::now())));
        $autores = "";

   foreach($libro->autor as $autor){
    $autores .= $autor->nombre." ".$autor->apellido;
    if($autor == $libro->autor->last())
        $autores .="."; 
    else
    $autores .=", "; 
   }

        $solicitud->setValue('fecha', $fecha_guardado);
        $solicitud->setValue('libro_nombre', $libro->titulo);
        $solicitud->setValue('libro_autores', $autores);

        $solicitud->saveAs('SolicitudLibro.docx');     
       

        return response()->download('SolicitudLibro.docx','solicitud.docx');
 

    }
    

    //CREA UN MENSAJE DE UN USUARIO 
    public function crearMensaje(Request $request){       
        $data = $request->all();
      // dd($data);
         $rules = array(
        'mensaje' => 'required|max:500',
        'archivo_imagen' => 'mimes:jpeg,bmp,png,pdf,doc,docx,xlsx|max:20480',
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 9);
        }
        else{
            if($data['mensaje_edit'] > 0){
                $mensaje = \App\Mensajes::find($data['mensaje_edit']);
                $mensaje->mensaje = $data['mensaje'];

                if($mensaje->archivo_id > 0){                    
                if(isset($data['archivo_imagen']) && $data['archivo_imagen'] != null)
                {
                
                //CREA UN NUEVO FILE Y LE ASIGNA LOS VALORES
                $file = \App\Archivo::find($mensaje->archivo_id);
                Storage::delete($file->ruta);
                $archivo = $data['archivo_imagen'];
                $file->tipodoc_id = 23; 
                $file->nombre = $archivo->getClientOriginalName();
                $file->nombre_subida = $archivo->getClientOriginalName();
                $file->extension = $archivo->extension();
                $file->peso = $archivo->getClientSize();
                $file->observaciones = "Archivo de mensaje guardado automaticamente";
     
                //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
                $path = Storage::putFile('/libros/libro'.$data['libro_id'].'/mensajes',$archivo);           
                $file->ruta = $path;
                $file->save();
                $libro_doc = \App\archivolibro::where('archivo_id',$mensaje->archivo_id)->first();
                $libro_doc->libro_id = $data['libro_id'];
                $libro_doc->archivo_id = $file->id;
                $libro_doc->save();
                $mensaje->archivo_id = $file->id;
                $mensaje->save();
                Session::flash('message','Mensaje editado correctamente');  
                }else{
                    $mensaje = \App\Mensajes::find($data['mensaje_edit']);
                $mensaje->mensaje = $data['mensaje'];
                $mensaje->save();
                Session::flash('message','Mensaje editado correctamente');  

                }                   
                }else{

                if(isset($data['archivo_imagen']) && $data['archivo_imagen'] != null)
                {
                //CREA UN NUEVO FILE Y LE ASIGNA LOS VALORES
                $file = new \App\Archivo;
                $archivo = $data['archivo_imagen'];
                $file->tipodoc_id = 23; 
                $file->nombre = $archivo->getClientOriginalName();
                $file->nombre_subida = $archivo->getClientOriginalName();
                $file->extension = $archivo->extension();
                $file->peso = $archivo->getClientSize();
                $file->observaciones = "Archivo de mensaje guardado automaticamente";
     
                //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
                $path = Storage::putFile('/libros/libro'.$data['libro_id'].'/mensajes',$archivo);           
                $file->ruta = $path;
                $file->save();
                $libro_doc = new \App\archivolibro;
                $libro_doc->libro_id = $data['libro_id'];
                $libro_doc->archivo_id = $file->id;
                $libro_doc->save();
                $mensaje->archivo_id = $file->id;
                }
                $mensaje->save();
                Session::flash('message','Mensaje editado correctamente');  
            }                    
            }else{
           $mensaje = new \App\Mensajes;
           $mensaje->libro_id = $data['libro_id'];
           $mensaje->user_id = \Auth::User()->id;
           $mensaje->mensaje = $data['mensaje'];
           
           if(isset($data['archivo_imagen']) && $data['archivo_imagen'] != null)
           {
           //CREA UN NUEVO FILE Y LE ASIGNA LOS VALORES
           $file = new \App\Archivo;
           $archivo = $data['archivo_imagen'];
           $file->tipodoc_id = 23; 
           $file->nombre = $archivo->getClientOriginalName();
           $file->nombre_subida = $archivo->getClientOriginalName();
           $file->extension = $archivo->extension();
           $file->peso = $archivo->getClientSize();
           $file->observaciones = "Archivo de mensaje guardado automaticamente";

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/libros/libro'.$data['libro_id'].'/mensajes',$archivo);           
           $file->ruta = $path;
           $file->save();
           $libro_doc = new \App\archivolibro;
           $libro_doc->libro_id = $data['libro_id'];
           $libro_doc->archivo_id = $file->id;
           $libro_doc->save();
           $mensaje->archivo_id = $file->id;
           }
           $mensaje->save();
          //dd($mensaje); 
     
          Session::flash('message','Mensaje creado correctamente');
    
        }

        $libro = \App\Libro::find($data['libro_id']);
        

        if( \Auth::User()->id != 1){
            if($libro->user->first() != null) {
                $user = $libro->user->first();
            } }
             else{ 
                  $user = \App\User::where('id',1)->get()->first(); 
            }
        
        
       // dd($data);
        Mail::send('mails.avisoMensaje', ['user' => $user,'libro'=>$libro,'mensaje'=>$data['mensaje']], function ($m) use ($user) {
          $m->from('ceid1994@gmail.com', 'Sistema de Gestion Editorial UCSG');

          $m->to($user->email, $user->name)->subject('Mensaje - Edición');
         });

        return redirect()->back(); 
      }
    }

     public function mensajedestroy($id){
         $mensaje = \App\Mensajes::find($id);
        //VERIFICA QUE EXISTA EL MENSAJE
         if(count($mensaje) > 0){
         $file = \App\Archivo::find($mensaje->archivo_id);
         //VERIFICA SI EXISTIA UN ARCHIVO VINCULADA A LA IMAGEN
         if(count($file) > 0){
             //ELIMINA ARCHIVO VINCULADO A LA IMAGEN
            $file->delete();
         }
        //ELIMINA MENSAJE
         $mensaje->delete();
         Session::flash('message','Mensaje eliminado con éxito.');
        }else{
            Session::flash('warning','Mensaje no encontrado.');  
        }
        return redirect()->back();
     }

     public function PasarCotizacionAprobado($id){
         $libro = \App\Libro::find($id);
         $libro->estados_id = 5;
         $libro->save();
         Session::flash('message','Se ha avanzado a estado Aprobado Cotización con éxito.');
         historial(\Auth::User()->name.' con id '.\Auth::User()->id.' y rol '.\Auth::User()->role->title.' ha aprobado el pase al estado Estado:Aprobado-Cotización',$libro->id); 
         return redirect()->back();
     }

     public function regresarEstado($id){
       $libro = \App\Libro::find($id);  
     
       switch ($libro->estados_id) {
        case 2:
                $archivo = $libro->archivo()->where('tipodoc_id', 13)->first();              
                $relacion = \App\archivolibro::where('libro_id',$libro->id)->where('archivo_id',$archivo->id)->first();
                Storage::delete($archivo->ruta);  
                $relacion->forcedelete();
                $archivo->forcedelete();
                $libro->estados_id = 1;
                $libro->save();
                Session::flash('message','Se ha regresado al estado '.$libro->estados->nombre.' exitosamente');
                break;

        case 3:
                $relacion = $libro->user()->first()->pivot;
                $relacion->forcedelete();
                $libro->estados_id = 2;
                $libro->asignado = 0;
                $libro->save();
                Session::flash('message','Se ha regresado al estado '.$libro->estados->nombre.' exitosamente');      
                break;
        case 4:
                $libro->estados_id = 3;
                $libro->save();
                Session::flash('message','Se ha regresado al estado '.$libro->estados->nombre.' exitosamente');      
                break;
           
        case 5:
                $libro->estados_id = 4;
                $libro->save();
                Session::flash('message','Se ha regresado al estado '.$libro->estados->nombre.' exitosamente');      
                break;
        case 6:
              $aprobado = $libro->cotizacion()->where('estado',1)->get()->first();
              $aprobado->estado = 0;
              $aprobado->save();
              $archivo = $libro->archivo()->where('tipodoc_id', 2)->first(); 
              Storage::delete($archivo->ruta);  
              $filebook = \App\archivolibro::get()->where('libro_id',$libro->id)->where('archivo_id',$archivo->id)->first();
              $filebook->forcedelete();                
              $archivo->forcedelete();         
              
              $libro->estados_id = 5;
              $libro->save();
              Session::flash('message','Se ha regresado al estado '.$libro->estados->nombre.' exitosamente');      
            break;
        case 7:
              $acta = $libro->archivo()->where('tipodoc_id',19)->first();
              Storage::delete($acta->ruta); 

              $filebook = \App\archivolibro::get()->where('libro_id',$libro->id)->where('archivo_id',$acta->id)->first();
              $filebook->forcedelete();  
              $acta->forcedelete();  

              $libro->estados_id = 6;
              $libro->save();
              Session::flash('message','Se ha regresado al estado '.$libro->estados->nombre.' exitosamente');    
            break;
        default:
           echo "HOLA MUNDO";
    }
    
    return redirect()->back();

     }

}
