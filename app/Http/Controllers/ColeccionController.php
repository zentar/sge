<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coleccion;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class ColeccionController extends Controller
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
        $colecciones = Coleccion::all();
        return view("colecciones/index",compact('colecciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colecciones/create');
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
        'descripcion' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $coleccion = New Coleccion;
           $input = array_filter($data,'strlen');
           $coleccion->fill($input);  
          // dd($coleccion);          
           $coleccion->save();          

           Session::flash('message','Registro agregado correctamente');
           return redirect()->action('ColeccionController@index'); 
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
        $colecciones = Coleccion::find($id);
        return view('colecciones/show', compact('colecciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colecciones = Coleccion::find($id);
        return view('colecciones/editar', compact('colecciones'));
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
        $rules = array(
        'titulo' => 'required',
        'descripcion' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $facultad = Coleccion::find($id);
           $facultad->titulo = $data['titulo']; 
           $facultad->descripcion = $data['descripcion'];          
           $facultad->save();          

           Session::flash('message','Registro editado correctamente');
           return redirect()->action('ColeccionController@index'); 
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
      $coleccion = Coleccion::find($id);
        if(empty($coleccion))
        {
            Session::flash('danger','Registro no encontrado');
            return redirect(route('coleccion.index'));
        }else{

             if(DB::table('books')->where('coleccion_id',$coleccion->id)->value('id')){
               Session::flash('danger','No se pudo borrar el Registro debido a que esta siendo utilizado.'); 
            }else{
            $coleccion->delete();
            Session::flash('message','Registro borrado sin problemas.');
            } 
           return redirect(route('coleccion.index'));

        }
    }
}
