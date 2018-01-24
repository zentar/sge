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
use App\Cotizacion;
use App\Book;
use Response;

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

   //MUESTRA IMAGEN ALMACENADA EN EL STORAGE 
   public function show($file)
    { 
      try{     
        //RECUPERA EL REGISTRO DEL ARCHIVO DE LA BD  
        $doc = File::find($file);
        //FILTRA POR EXTENSION DE ARCHIVO EL MODO DE PRESENTACION
        if($doc->extension=='jpeg' || $doc->extension=='png' || $doc->extension=='bmp' ||
           $doc->extension=='jpg'){  
           $image = storage_path('app/'.$doc->ruta); 
           return response()->file($image);

        }
        if($doc->extension=='xlsx' || $doc->extension=='docx' || $doc->extension=='doc' ||
           $doc->extension=='pdf'){ 
          $documento = storage_path('app/'.$doc->ruta);         
          return response()->file($documento);
      }
     }catch(\Exception $e){
          abort(404);         //return $e->getMessage();
     }

    }


    //CREA UN FILE Y SU VINCULACION CON EL AUTOR
    public function crear_autor(Request $request){
        $data = $request->all();
        //dd($data);
        if($data['tipo_doc'][0]=="null"){$data['tipo_doc']=null;}
        //VALIDA DATOS INGRESADOS
        $rules = array(
        'tipo_doc' => 'required',
        'documento' => 'required|mimes:jpeg,bmp,png,pdf,doc,docx,xlsx|max:5000'
        );    

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
          //CREA UN NUEVO FILE (ARCHIVO) Y LE ASIGNA LOS VALORES
           $file = new file();
           $archivo = $data['documento'];
           $file->tipodoc_id = $data['tipo_doc'][0]; 
           $file->nombre = $archivo->getClientOriginalName();
           $file->nombre_subida = $archivo->getClientOriginalName();
           $file->extension = $archivo->extension();
           $file->peso = $archivo->getClientSize();

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/autor/autor'.$data['autor_id'],$request->file('documento'));
          
          // CON NOMBRE ASIGNADO  
          // $path = Storage::putFileAs('/autor/autor'.$data['autor_id'],$request->file('documento'),'HOLAMUNDO.'.$file->extension);
           
           $file->ruta = $path;
           $file->save();
           
           //CREA RELACION ENTRE ARCHIVO Y EL AUTOR
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
     $file = file::find($id);
     Storage::delete($file->ruta);

     $autor_doc = fileautor::get()->where('file_id',$id)->first();
     $autor_doc->delete();
     
     Session::flash('message','Registro borrado sin problemas.');
     return redirect()->back(); 
    }   

     //CREA UN FILE Y SU VINCULACION CON EL LIBRO
    public function crear_libro(Request $request){
        $data = $request->all();
       // dd($data);
        if($data['tipo_doc'][0]=="null"){$data['tipo_doc']=null;}
        $rules = array(
        'tipo_doc' => 'required',
        'documento' => 'required|mimes:jpeg,bmp,png,pdf,doc,docx,xlsx|max:5000'
        );    

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          return redirect()->back()
                ->withErrors($v->errors())->with('error_code', 6)
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
          if(isset($data['observaciones'])) $file->observaciones = $data['observaciones'];

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/libros/libro'.$data['libro_id'],$request->file('documento'));
           
           $file->ruta = $path;
           $file->save();

           $libro_doc = new filebook();
           $libro_doc->book_id = $data['libro_id'];
           $libro_doc->file_id = $file->id;
           $libro_doc->save();

           if($data['tipo_doc'][0] == 13){
               $libro = Book::find($data['libro_id']);
               $libro->estados_id = 2;
               $libro->save();   
               historial('Registro documento de solicitud de aprobación, estado aprobado',$libro->id);              
           }


           return redirect()->back(); 
        }

    }

   //ELIMINA DOCUMENTO Y SU VINCULACION CON EL LIBRO
    public function delete_libro($id){ 

     $file = file::find($id);
   //dd($file);
     //SI EL DOCUMENTO ES DE APROBACION DE COTIZACION, DESHACE LA ACCION DE APROBACION
     if($file->tipodoc_id == 2){
      $libro_doc = filebook::get()->where('file_id',$id)->first(); 
      $libro = Book::find($libro_doc->book_id);
      foreach($libro->cotizacion as $cotizacion){
       if($cotizacion->estado > 0){
           foreach($libro->file as $documentos){
              if($documentos->tipodoc_id == 2){
               //COLOCO EN 0 EL ESTADO APROBADO ANTERIOR                                     
               $cotizacion->estado = 0;
               //ELIMINA ARCHIVO DEL ESTADO APROBADO ANTERIOR 
               Storage::delete($documentos->ruta);
               $cotizacion->save();  
               // ELIMINA REGISTRO DE RELACION AUTOR CON ARCHIVO APROBADO ANTERIOR
               $filebook = filebook::get()->where('book_id',$libro->id)->where('file_id',$documentos->id)->first();
               $filebook->delete();
               //ELIMINA EL REGISTRO DEL ARCHIVO APROBADO ANTERIOR
               $documentos->delete();                  
              }                 
             
           }            
       }
     }
     return redirect()->back();
     }


     Storage::delete($file->ruta);

     $libro_doc = filebook::get()->where('file_id',$id)->first();
     $libro_doc->delete();

     Session::flash('message','Registro borrado sin problemas.');
     return redirect()->back(); 
 
    }

    //CREA UNA COTIZACION, SU FILE Y SU VINCULACION CON EL LIBRO
    public function crear_cotizacion(Request $request){
      $data = $request->all(); 
     // dd($data);
        $rules = array(
        'imprenta' => 'required',
        'documento' => 'required|mimes:jpeg,bmp,png,pdf,doc,docx,xlsx|max:5000'
        );    

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          return redirect()->back()->withInput()->withErrors($v->errors())->with('error_code', 7);
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
           $file->observaciones = "Cotizacion generada automáticamente."; 

           //GUARDA IMAGEN SUBIDA A RUTA AUTOR/AUTOR Y DEVUELVE EL PATH EN DONDE SE ALMACENO
           $path = Storage::putFile('/libros/libro'.$data['libro_id'].'/cotizacion',$request->file('documento'));
           
           $file->ruta = $path;
           $file->save();

           $cotizacion = new Cotizacion();
           $cotizacion->book_id = $data['libro_id'];
           $cotizacion->file_id = $file->id;
           $cotizacion->imprenta = $data['imprenta'];
           $cotizacion->tiraje = $data['tiraje'];
           $cotizacion->valor = $data['valor'];

           if(isset($data['iva']) ){
            $cotizacion->iva = 1; 
            $cotizacion->total = $data['valor'] * 1.12;
           }else{
            $cotizacion->iva = 0;  
            $cotizacion->total = $data['valor'];
           }
          

           $cotizacion->estado = 0;
           $cotizacion->save();
           Session::flash('message','Registro ingresado sin problemas.');
           
           }
           else{
           $file = file::find($data['file_id']);
           //dd(storage_path('app/'.$file->ruta));
  
           Storage::delete($file->ruta);
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

           if(isset($data['iva']) ){
            $cotizacion->iva = 1; 
            $cotizacion->total = $data['valor'] * 1.12;
           }else{
            $cotizacion->iva = 0;  
            $cotizacion->total = $data['valor'];
           }
          
           
           $cotizacion->save();
           Session::flash('message','Registro editado sin problemas.');    
          }
          return redirect()->back(); 
        }
    }
  

    //ELIMINA COTIZACION, SU DOCUMENTO Y SU VINCULACION CON EL LIBRO (LOGICO)
    public function delete_cotizacion($id){  
      //ENCUENTRA COTIZACION CONSULTADA
      $cotizacion = cotizacion::find($id);
      
      //VERIFICA QUE LA COTIZACION NO ESTE APROBADA
      if($cotizacion->estado > 0 ){
        //SI ESTA APROBADA, NO PERMITE SU ELIMINACION, SE DEBE ELIMINAR SU APROBACION ANTES
        Session::flash('danger','Esta cotización ya esta aprobada y no puede ser eliminada.');   
        return redirect()->back()->with('error_code', 7);
      }      
      else{
      //SI NO ESTA APROBADA SE PROCEDE A LA ELIMINACION DEL REGISTRO DE COTIZACION
      $cotizacion->delete();      
      $file = $cotizacion->file;
      //A LA ELIMINACION DE LA IMAGEN FISICA DE LA COTIZACION
      Storage::delete($file->ruta);
      //A LA ELIMINACION DEL REGISTRO DE LA IMAGEN
      $file->delete();
      }
      return redirect()->back();
    }

    //CREA EL DOCUMENTO DE LA COTIZACION APROBADO
    public function crear_cotizacion_aprobado(Request $request){
       $data = $request->all();  
       // VALIDA QUE LOS DATOS INGRESADOS SEAN CORRECTOS
       if($data['aprobado_id']=='null') $data['aprobado_id']=null;
        $rules = array(
        'aprobado_id' => 'required',
        'documento' => 'required'
        );    

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          //RETORNA EN CASO DE DATOS MAL INGRESADOS O FALTANTES
          return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 8);
        }
        else{
          $libro = Book::find($data['libro_id']);
         foreach($libro->cotizacion as $cotizacion){
          if($cotizacion->estado > 0){
              foreach($libro->file as $documentos){
                 if($documentos->tipodoc_id == 2){
                  //COLOCO EN 0 EL ESTADO APROBADO ANTERIOR                                     
                  $cotizacion->estado = 0;
                  //ELIMINA ARCHIVO DEL ESTADO APROBADO ANTERIOR 
                  Storage::delete($documentos->ruta);
                  $cotizacion->save();  
                  // ELIMINA REGISTRO DE RELACION AUTOR CON ARCHIVO APROBADO ANTERIOR
                  $filebook = filebook::get()->where('book_id',$libro->id)->where('file_id',$documentos->id)->first();
                  $filebook->delete();
                  //ELIMINA EL REGISTRO DEL ARCHIVO APROBADO ANTERIOR
                  $documentos->delete();                  
                 }                 
                
              }            
          }
        }
          //CAMBIA EL ESTADO DE LA COTIZACION A ACEPTADO
          $cotizacion = cotizacion::find($data['aprobado_id']);  
          $cotizacion->estado = 1;
          $cotizacion->save();       
          
          //GRABA UN NUEVO FILE CON EL DOCUMENTO DE ACEPTACION DE COTIZACION
          $archivo = $data['documento'];
          $file = new File;
          $file->tipodoc_id = 2; 
          $file->nombre = $archivo->getClientOriginalName();
          $file->nombre_subida = $archivo->getClientOriginalName();
          $file->extension = $archivo->extension();
          $file->peso = $archivo->getClientSize();
          $file->observaciones = "Documento de Cotización aprobado de imprenta ".$cotizacion->imprenta." con tiraje de ".$cotizacion->tiraje." ejemplares y valor de $".$cotizacion->total;

           //GUARDA IMAGEN SUBIDA A RUTA /libros/librox/cotizacion Y DEVUELVE EL PATH EN DONDE SE ALMACENO
          $path = Storage::putFile('/libros/libro'.$cotizacion->book_id.'/cotizacion',$request->file('documento'));
          
          //ALMACENA IMAGEN DEL DOCUMENTO DE ACEPTACION DE COTIZACION
          $file->ruta = $path;        
          $file->save();

          //CREA RELACION ENTRE EL LIBRO Y EL DOCUMENTO CREADO
          $filebook = new filebook;
          $filebook->book_id = $cotizacion->book_id;
          $filebook->file_id =  $file->id;
          $filebook->save();   
          
          //UNA VEZ SUBIO EL DOCUMENTO APROBADO, EL LIBRO PASA AL ESTADO PRODUCCION
          $libro->estados_id = 6;
          historial('Se subio documento de aprobación - Estado Producción ',$libro->id);             
          $libro->save();
 
          return redirect()->back();
        }
    }
}
