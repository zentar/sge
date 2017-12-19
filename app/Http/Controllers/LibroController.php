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
        'titulo' => 'required',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Book::find($id);
        $autores = Autor::all();
        $colecciones = Coleccion::all();

        $tipos = Tipodoc::all();

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
       // dd($libro->cotizacion[0]->file->id);                 
        return view('libros/editar/editar', compact('libro','autores_nombre','flag_editar_autor','facultades_nombre','colecciones','tipos'));
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
        $rules = array(
           "facultad_id" => 'required',
           "autor" => 'required',
           "coleccion_id" => 'required'
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
              if(isset($data['tamano']))
              $caracteristicas->tamano = $data['tamano'];
              else
              $caracteristicas->tamano = "-";  

              if(isset($data['tpapel']))
              $caracteristicas->tipo_papel = $data['tpapel'];
              else
              $caracteristicas->tipo_papel = "-";  

              if(isset($data['paginas']))
              $caracteristicas->n_paginas = $data['paginas'];
              else
              $caracteristicas->n_paginas = "-";  

              if(isset($data['color']))
              $caracteristicas->color = $data['color'];
              else
              $caracteristicas->color = "-";  

              if(isset($data['cubierta']))
              $caracteristicas->cubierta = $data['cubierta'];
              else
              $caracteristicas->cubierta = "-";  

              if(isset($data['solapa']))
              $caracteristicas->solapas = $data['solapa'];
              else
              $caracteristicas->solapas = "-";  

              if(isset($data['observaciones']))
              $caracteristicas->observaciones = $data['observaciones'];
              else
              $caracteristicas->observaciones = "-";  

              $caracteristicas->save();

              //LIBRO            
              $libro = Book::find($id);            
              $libro->titulo = $data["titulo"];
              $libro->coleccion_id = $data["coleccion_id"];
              $libro->facultad_id = $data["facultad_id"];
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

       public function consultar(Request $request, $id)
    {
        $libro = Book::find($id);
       // dd($libro->estados);
        return view('libros/consultar', compact('libro'));
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

    public function agregarDocumentos(Request $request, $id)
    {
      $tipos = Tipodoc::get();
      $libro = Book::find($id);
      return view('libros/documentos', compact('tipos','libro'));
    }

    public function editarDocumentos(Request $request, $id)
    {
      $tipos = Tipodoc::get();
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
      $libro = Book::find($id); 
     // dd($libro->cotizacion[0]->file);
     return view('libros/cotizacion', compact('tipos','libro'));
}
}
