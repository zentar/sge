<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Autores;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $autores=Autores::get(); 
       //dd($autores);
       return view("autores/index",compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('autores/create');
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
       // dd($data);
        $rules = array(
        'cedula' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required',
        'telefono' => 'required'
        );

        if($data['filiacion']==null)$data['filiacion']='-';
        if($data['documentos']==null)$data['documentos']='-';

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $autor = New Autores;
           $input = array_filter($data,'strlen');
           $autor->fill($input);
           $autor->save();
           Session::flash('message','Registro agregado correctamente');
           return redirect()->action('AutorController@index'); 
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
        $autor = Autores::find($id);
        return view('autores/editar', compact('autor'));
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
        'cedula' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required',
        'telefono' => 'required'
        );

        $v=Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
            $autor = Autores::find($id);
            $input = array_filter($data,'strlen');
            $autor->fill($input);
            //dd($libro);
            $autor->save();
            Session::flash('message','Registro editado correctamente');
            return redirect()->action('AutorController@index'); 
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
         $autor = Autores::find($id);
        if(empty($autor))
        {
            Session::flash('message','Registro no encontrado');
             return redirect()->action('AutorController@index'); 
        }else{
            $autor->delete();
            Session::flash('message','Registro borrado sin problemas.');
            return redirect()->action('AutorController@index'); 
        }
    }

     public function consultar(Request $request, $id)
    {
        $autores = Autores::find($id); 

        return view('autores/consultar', compact('autores'));
    }
}
