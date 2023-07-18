<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class ParametrosController extends Controller
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
        $campos_generales = \App\CampoGeneral::all();
        $campos_especificos = \App\CampoEspecifico::all();
        $campos_detallado = \App\CampoDetallado::all();

      //  dd($campos_generales);
        return view("parametros/index",compact('campos_generales'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("parametros/nuevoGeneral"); 
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
        $rules = array(
        'codigo' => 'required',
        'titulo' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
            
            $campo_general = new \App\CampoGeneral;
            $campo_general->codigo =$data['codigo'] ;
            $campo_general->titulo = $data['titulo'];
            $campo_general->save();

            Session::flash('message','Campo General creado correctamente');
            return redirect()->back();
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
        $campos_especificos = \App\CampoEspecifico::where('campo_general',$id)->get();
        $campos_general = \App\CampoGeneral::find($id);        
        return view("parametros/indexEspecifico",compact('campos_especificos','campos_general'));  
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexDetallado($id){
        $detalle = \App\CampoDetallado::where('campo_especifico',$id)->get();
        $campos_especifico = \App\CampoEspecifico::find($id); 
        return view("parametros/indexDetallado",compact('detalle','campos_especifico')); 
    }

    public function nuevoDetallado($id){
        $campo_especifico = \App\CampoEspecifico::find($id); 
        return view("parametros/nuevoDetallado",compact('campo_especifico')); 
    }

    public function nuevoEspecifico($id){
        $campo_general = \App\CampoGeneral::find($id); 
        return view("parametros/nuevoEspecifico",compact('campo_general')); 
    }

    public function storeDetallado(Request $request){
      
        $data = $request->all();
        $rules = array(
        'codigo' => 'required',
        'titulo' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
            
            $campo_detallado = new \App\CampoDetallado;
            $campo_detallado->codigo =$data['codigo'] ;
            $campo_detallado->titulo = $data['titulo'];
            $campo_detallado->campo_especifico = $data['campo_especifico'];
            $campo_detallado->save();

            Session::flash('message','Campo detallado creado correctamente');
            return redirect()->back(); 

        }
     
    }

    public function storeEspecifico(Request $request){  
        $data = $request->all();
        $rules = array(
        'codigo' => 'required',
        'titulo' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{            
            $campo_especifico = new \App\CampoEspecifico;
            $campo_especifico->codigo =$data['codigo'] ;
            $campo_especifico->titulo = $data['titulo'];
            $campo_especifico->campo_general= $data['campo_general'];
            $campo_especifico->save();

            Session::flash('message','Campo especifico creado correctamente');
            return redirect()->back(); 

        }
     
    }
    

    public function editGeneral($id){
        $campo_general = \App\CampoGeneral::find($id);
        return view("parametros/editGeneral",compact('campo_general')); 
    }

    public function editDetallado($id){
        $campo_detallado = \App\CampoDetallado::find($id);
        $campo_especifico = \App\CampoEspecifico::find($campo_detallado->campo_especifico); 
        return view("parametros/editDetallado",compact('campo_detallado','campo_especifico')); 
    }

    public function editEspecifico($id){
        $campo_especifico = \App\CampoEspecifico::find($id);
        $campo_general = \App\CampoGeneral::find($campo_especifico->campo_general); 
        return view("parametros/editEspecifico",compact('campo_especifico','campo_general')); 
    }

    public function updateDetallado(Request $request){
        $data = $request->all();
        $rules = array(
        'codigo' => 'required',
        'titulo' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{            
            $campo_especifico = \App\CampoDetallado::find($data['id']);
            $campo_especifico->codigo =$data['codigo'] ;
            $campo_especifico->titulo = $data['titulo'];
            $campo_especifico->save();

            Session::flash('message','Campo Detallado editado correctamente');
            return redirect()->back(); 

        }
     
    }

    public function updateEspecifico(Request $request){
        $data = $request->all();
        $rules = array(
        'codigo' => 'required',
        'titulo' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{            
            $campo_especifico = \App\CampoEspecifico::find($data['id']);
            $campo_especifico->codigo =$data['codigo'] ;
            $campo_especifico->titulo = $data['titulo'];
            $campo_especifico->save();

            Session::flash('message','Campo Especifico editado correctamente');
            return redirect()->back(); 

        }
     
    }


    public function updateGeneral(Request $request){
        $data = $request->all();
        $rules = array(
        'codigo' => 'required',
        'titulo' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{            
            $campo_general = \App\CampoGeneral::find($data['id']);
            $campo_general->codigo =$data['codigo'] ;
            $campo_general->titulo = $data['titulo'];
            $campo_general->save();

            Session::flash('message','Campo General editado correctamente');
            return redirect()->back(); 
        }     
    }

    public function destroyDetallado($id){
        $campo_detallado = \App\CampoDetallado::find($id);

        $libros = \App\Libro::where('campo_detallado',$id)->count();

        if($libros > 0){
            Session::flash('warning','No se puede eliminar debido a que se encuentra actualmente asignado a un libro');
            return redirect()->back(); 
        }else{
            $campo_detallado->delete();
            Session::flash('message','Campo Eliminado Exitosamente.');
            return redirect()->back(); 

        }
    }

    public function destroyEspecifico($id){
        $campo_especifico = \App\CampoEspecifico::find($id);

        $libros = \App\Libro::where('campo_especifico',$id)->count();

        if($libros > 0){
            Session::flash('warning','No se puede eliminar debido a que se encuentra actualmente asignado a un libro');
            return redirect()->back(); 
        }else{
            $campo_detallado = \App\CampoDetallado::where('campo_especifico',$id)->get();
            $uso=[];
            
            foreach($campo_detallado as $detalle){
                $libros_detallado = \App\Libro::where('campo_detallado',$detalle->id)->count();
                if($libros_detallado > 0){
                    array_push($uso,1);                    
                }            
            }    

            if(count($uso)>0){
                Session::flash('warning','No se puede eliminar debido a que un campo detallado perteneciente a este campo se encuentra actualmente asignado a un libro');
                return redirect()->back(); 
            }else{
                $campo_especifico->delete();
            Session::flash('message','Campo Especifico Eliminado Exitosamente.');
            return redirect()->back(); 
            }
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campo_general = \App\CampoGeneral::find($id);

        $libros = \App\Libro::where('campo_general',$id)->count();

        $uso = [];
        $uso2 = [];

        if($libros > 0){
            Session::flash('warning','No se puede eliminar debido a que se encuentra actualmente asignado a un libro');
            return redirect()->back(); 
        }else{
            $campo_especifico = \App\CampoEspecifico::where('campo_general',$id)->get();
            $uso=[];
            
            foreach($campo_especifico as $detalle){
                $libros_especificos = \App\Libro::where('campo_especifico',$detalle->id)->count();
                if($libros_especificos > 0){
                    array_push($uso,1);                    
                }            
            }    

            if(count($uso)>0){
                Session::flash('warning','No se puede eliminar debido a que un campo especifico perteneciente a este campo se encuentra actualmente asignado a un libro');
                return redirect()->back(); 
            }else{
                foreach($campo_especifico as $campos){ 
                $campo_detallado = \App\CampoDetallado::where('campo_especifico',$campos->id)->get();
                $uso=[];
                
                foreach($campo_detallado as $detalle){
                    $libros_detallado = \App\Libro::where('campo_detallado',$detalle->id)->count();
                    if($libros_detallado > 0){
                        array_push($uso2,1);                    
                    }            
                }    
            }  
                if(count($uso2)>0){
                    Session::flash('warning','No se puede eliminar debido a que un campo detallado perteneciente a este campo se encuentra actualmente asignado a un libro');
                    return redirect()->back(); 
                }else{
                    $campo_general->delete();
                Session::flash('message','Campo General Eliminado Exitosamente.');
                return redirect()->back(); 
                }
            }

       }
}
}
