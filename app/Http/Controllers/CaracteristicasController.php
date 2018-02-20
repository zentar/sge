<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

class CaracteristicasController extends Controller
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
        $tipo_papel = \App\TipoPapel::all(); 
        $tamano_papel = \App\TamanoPapel::all(); 
        $color_papel = \App\ColorPapel::all();
        return view('caracteristicas/index', compact('tipo_papel','tamano_papel','color_papel'));
    }

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createtamano(Request $request)
    {
        $data = $request->all(); 
         $rules = array(
        'descripcion_tamano' => 'required'     
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
                return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 11)->with('old_caracteristica','tamanopapel');
              
        }
        else{    
             if( isset($data['tamanopapel_edit']) && $data['tamanopapel_edit'] > 0){
              $registro = \App\TamanoPapel::find($data['tamanopapel_edit']);
              $registro->descripcion = $data['descripcion_tamano'];         
              $registro->save();  
              Session::flash('message','Categoria: tamaño de papel editado correctamente');  
            }else{
            $registro = new \App\TamanoPapel;
            $registro->descripcion = $data['descripcion_tamano'];
            $registro->save();
       Session::flash('message','Categoria tamaño de papel agregado correctamente');  
       }         
       return redirect()->back()->with('old_caracteristica','tamanopapel'); 
      }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createtipo(Request $request)
    {
        $data = $request->all(); 
       // dd($data);
         $rules = array(
        'descripcion_tipo' => 'required'     
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {         
               return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 10)->with('old_caracteristica','tipopapel');;                
        }
        else{    
            if( isset($data['tipopapel_edit']) && $data['tipopapel_edit'] > 0){
              $registro = \App\TipoPapel::find($data['tipopapel_edit']);
              $registro->descripcion = $data['descripcion_tipo'];         
              $registro->save();  
              Session::flash('message','Categoria: tipo de papel editado correctamente');  
            }else{
            $registro = new \App\TipoPapel;
            $registro->descripcion = $data['descripcion_tipo'];         
            $registro->save();
       Session::flash('message','Categoria: tipo de papel ingresado correctamente');  
       }         
       return redirect()->back()->with('old_caracteristica','tipopapel');; 
      }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createcolor(Request $request)
    {
         $data = $request->all(); 
        // dd($data);
         $rules = array(
        'descripcion_color' => 'required'     
        );


        $v = Validator::make($data,$rules);
        if($v->fails())
        {
                return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 12)->with('old_caracteristica','colorpapel');
        }
        else{
             if( isset($data['colorpapel_edit']) && $data['colorpapel_edit'] > 0){
              $registro = \App\ColorPapel::find($data['colorpapel_edit']);
              $registro->descripcion = $data['descripcion_color'];         
              $registro->save();  
              Session::flash('message','Categoria: Color de papel editado correctamente');  
            }else{       
            $registro = new \App\ColorPapel;
            $registro->descripcion = $data['descripcion_color'];
            $registro->save();
              Session::flash('message','Categoria: color de papel agregado correctamente');
        }

        }
                
       return redirect()->back()->with('old_caracteristica','colorpapel'); 
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroytamanopapel($id)
    {
       $registro = \App\TamanoPapel::find($id);
    
        if(empty($registro))
        {
            Session::flash('danger','Registro no encontrado');
           return redirect()->back()->with('old_caracteristica','tamanopapel');
        }else{
               $verificacion = \App\Caracteristicas::where('tamano',$registro->id)->count();

            if($verificacion > 0){
               Session::flash('danger','No se pudo borrar el registro debido a que esta siendo utilizado.'); 
            }else{
            $registro->delete();
            Session::flash('message','Registro borrado sin problemas.');
            }           

           return redirect()->back()->with('old_caracteristica','tamanopapel'); 
        }
     
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroytipopapel($id)
    {
        $registro = \App\TipoPapel::find($id);
    
        if(empty($registro))
        {
            Session::flash('danger','Registro no encontrado');
            return redirect()->back()->with('old_caracteristica','tipopapel');
        }else{
               $verificacion = \App\Caracteristicas::where('tipopapel_id',$registro->id)->count();

            if($verificacion > 0){
               Session::flash('danger','No se pudo borrar el registro debido a que esta siendo utilizado.'); 
            }else{
            $registro->delete();
            Session::flash('message','Registro borrado sin problemas.');
            }           

           return redirect()->back()->with('old_caracteristica','tipopapel'); 
        }
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroycolorpapel($id)
    { 
        $registro = \App\ColorPapel::find($id);
    
        if(empty($registro))
        {
            Session::flash('danger','Registro no encontrado');
            return redirect()->back()->with('old_caracteristica','colorpapel');
        }else{
               $verificacion = \App\Caracteristicas::where('colorpapel_id',$registro->id)->count();

            if($verificacion > 0){
               Session::flash('danger','No se pudo borrar el registro debido a que esta siendo utilizado.'); 
            }else{
            $registro->delete();
            Session::flash('message','Registro borrado sin problemas.');
            }           

           return redirect()->back()->with('old_caracteristica','colorpapel'); 
        }

    }
}
