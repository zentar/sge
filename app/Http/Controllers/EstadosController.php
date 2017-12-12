<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estados;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;
class EstadosController extends Controller
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
        $estados = estados::all();
        return view("estados/index",compact('estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estados/create');
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
        'nombre' => 'required',
        'descripcion' => 'required',
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $estado = New Estados;
           $input = array_filter($data,'strlen');
           $estado->fill($input);            
           $estado->save();          

           Session::flash('message','Registro agregado correctamente');
           return redirect()->action('EstadosController@index'); 
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
        $estados = Estados::find($id);
        return view('estados/show', compact('estados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = Estados::find($id);
        return view('estados/editar', compact('estados'));
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
        'nombre' => 'required',
        'descripcion' => 'required',
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $estado = Estados::find($id);
           $estado->nombre = $data['nombre'];
           $estado->descripcion = $data['descripcion'];           
           $estado->save();          

           Session::flash('message','Registro editado correctamente');
           return redirect()->action('EstadosController@index'); 
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
        $estado = Estados::find($id);
        if(empty($estado))
        {
            Session::flash('danger','Registro no encontrado');
            return redirect(route('estados.index'));
        }else{

            if(DB::table('books')->where('estados_id',$estado->id)->value('id')){
               Session::flash('danger','No se pudo borrar el Registro debido a que esta siendo utilizado.'); 
            }else{
            $estado->delete();
            Session::flash('message','Registro borrado sin problemas.');
            }           

           return redirect(route('estados.index'));
        }
    }
}
