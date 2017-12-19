<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Autor;
use App\File;
use App\fileautor;
use App\filebook;
use App\cotizacion;

class ImageController extends Controller
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

   //MUESTRA IMAGEN GUARDADA DEL AUTOR 
   public function show($file)
    {        
        $doc = File::find($file);  
        $image = storage_path('app/'.$doc->ruta);      
        return \Image::make($image)->response();
    }


    //CREA UN FILE Y SU VINCULACION CON EL AUTOR
    public function crear_autor(Request $request){
        $data = $request->all();

        $rules = array(
        'tipo_doc' => 'required',
        'documento' => 'required'
        );    

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
          //CREA UN NUEVO FILE Y LE ASIGNA LOS VALORES
           $file = new file();
           $archivo = $data['documento'];
           $file->tipodoc_id = $data['tipo_doc'][0]; 
           $file->nombre = $archivo->getClientOriginalName();
           $file->nombre_subida = $archivo->getClientOriginalName();
           $file->extension = $archivo->extension();
           $file->peso = $archivo->getClientSize();

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/autor/autor'.$data['autor_id'],$request->file('documento'));
           
           $file->ruta = $path;
           $file->save();

           $autor_doc = new fileautor();
           $autor_doc->autor_id = $data['autor_id'];
           $autor_doc->file_id = $file->id;
           $autor_doc->save();
           return redirect()->back(); 
        }

    }


    //ELIMINA DOCUMENTO VINCULADO A UN AUTOR.
    public function delete_autor($id)
    {
     //Storage::delete($autor->documentos);    
     $autor_doc = fileautor::get()->where('file_id',$id)->first();
     $autor_doc->delete();
     Session::flash('message','Registro borrado sin problemas.');
     return redirect()->back(); 
    }   

     //CREA UN FILE Y SU VINCULACION CON EL LIBRO
    public function crear_libro(Request $request){
        $data = $request->all();
        $rules = array(
        'tipo_doc' => 'required',
        'documento' => 'required'
        );    

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
          //CREA UN NUEVO FILE Y LE ASIGNA LOS VALORES
           $file = new file();
           $archivo = $data['documento'];
           $file->tipodoc_id = $data['tipo_doc'][0]; 
           $file->nombre = $archivo->getClientOriginalName();
           $file->nombre_subida = $archivo->getClientOriginalName();
           $file->extension = $archivo->extension();
           $file->peso = $archivo->getClientSize();

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/libros/libro'.$data['libro_id'],$request->file('documento'));
           
           $file->ruta = $path;
           $file->save();

           $libro_doc = new filebook();
           $libro_doc->book_id = $data['libro_id'];
           $libro_doc->file_id = $file->id;
           $libro_doc->save();

           return redirect()->back(); 
        }

    }

   //ELIMINA DOCUMENTO Y SU VINCULACION CON EL LIBRO
    public function delete_libro($id){    
     $libro_doc = filebook::get()->where('file_id',$id)->first();
     $libro_doc->delete();
     Session::flash('message','Registro borrado sin problemas.');
     return redirect()->back(); 
 
    }

    //CREA UNA COTIZACION, SU FILE Y SU VINCULACION CON EL LIBRO
    public function crear_cotizacion(Request $request){
      $data = $request->all();  
      //dd($data);
        $rules = array(
        'imprenta' => 'required',
        'documento' => 'required'
        );    

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
          if($data['cotizacion_edit'] == "0"){ 
           //CREA UN NUEVO FILE Y LE ASIGNA LOS VALORES
           $file = new file();
           $archivo = $data['documento'];
           $file->tipodoc_id = 1; 
           $file->nombre = $archivo->getClientOriginalName();
           $file->nombre_subida = $archivo->getClientOriginalName();
           $file->extension = $archivo->extension();
           $file->peso = $archivo->getClientSize();

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/libros/libro'.$data['libro_id'].'/cotizacion',$request->file('documento'));
           
           $file->ruta = $path;
           $file->save();

           $cotizacion = new cotizacion();
           $cotizacion->book_id = $data['libro_id'];
           $cotizacion->file_id = $file->id;
           $cotizacion->imprenta = $data['imprenta'];
           $cotizacion->tiraje = $data['tiraje'];
           $cotizacion->valor = $data['valor'];
           $cotizacion->estado = 0;
           $cotizacion->save();
           Session::flash('message','Registro ingresado sin problemas.');
           
           }
           else{
           $file = file::find($data['file_id']);
          // dd(storage_path('app/'.$file->ruta));
           Storage::delete(storage_path('app/'.$file->ruta));

           $archivo = $data['documento'];
           $file->tipodoc_id = 1; 
           $file->nombre = $archivo->getClientOriginalName();
           $file->nombre_subida = $archivo->getClientOriginalName();
           $file->extension = $archivo->extension();
           $file->peso = $archivo->getClientSize();

            //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/libros/libro'.$data['libro_id'].'/cotizacion',$request->file('documento'));
           
           $file->ruta = $path;
           $file->save();

           $cotizacion = cotizacion::find($data['cotizacion_edit']);
           $cotizacion->book_id = $data['libro_id'];
           $cotizacion->file_id = $file->id;
           $cotizacion->imprenta = $data['imprenta'];
           $cotizacion->tiraje = $data['tiraje'];
           $cotizacion->valor = $data['valor'];
           $cotizacion->estado = 0;
           $cotizacion->save();
           Session::flash('message','Registro editado sin problemas.');    
          }
          return redirect()->back(); 
        }
    }
  

    //ELIMINA COTIZACION, SU DOCUMENTO Y SU VINCULACION CON EL LIBRO (LOGICO)
    public function delete_cotizacion($id){  
      $cotizacion = cotizacion::find($id);
      $cotizacion->delete();
      $file = $cotizacion->file;
      $file->delete();
      return redirect()->back();
    }



}
