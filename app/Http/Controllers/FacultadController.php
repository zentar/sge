<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facultad;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class FacultadController extends Controller
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
       $facultades = Facultad::all();
       return view("facultades/index",compact('facultades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facultades/create');
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
        'nombre' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $facultad = New Facultad;
           $input = array_filter($data,'strlen');
           $facultad->fill($input);  
          // dd($facultad);          
           $facultad->save();          

           Session::flash('message','Registro agregado correctamente');
           return redirect()->action('FacultadController@index'); 
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
        $facultades = Facultad::find($id);
        return view('facultades/show', compact('facultades'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facultades = Facultad::find($id);
        return view('facultades/editar', compact('facultades'));
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
        'nombre' => 'required'
        );

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
        return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $facultad = Facultad::find($id);
           $facultad->nombre = $data['nombre'];          
           $facultad->save();          

           Session::flash('message','Registro editado correctamente');
           return redirect()->action('FacultadController@index'); 
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
      $facultad = Facultad::find($id);
        if(empty($facultad))
        {
            Session::flash('danger','Registro no encontrado');
            return redirect(route('facultad.index'));
        }else{

             if(DB::table('books')->where('facultad_id',$facultad->id)->value('id')){
               Session::flash('danger','No se pudo borrar el Registro debido a que esta siendo utilizado.'); 
            }else{
            $facultad->delete();
            Session::flash('message','Registro borrado sin problemas.');
            } 
           return redirect(route('facultad.index'));

        }
    }
}
