<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Autor;
use App\autorbook;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class AutorController extends Controller
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
       $autores=Autor::get(); 
      // dd($autores[0]->capitulos);
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
       // dd($file);
       // $path="";
        $path = Storage::putFile(null,$request->file('documentos'));

        $rules = array(
        'cedula' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required',
        'telefono' => 'required',
        'documentos' =>'required'
        );
        
        if($data['filiacion']==null)$data['filiacion']='-';
        if($data['documentos']==null)$data['documentos']='-';

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
          return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 5)->with('facultad_old', $request->facultad_old);
        }
        else{
           
            $autor = New Autor;           
            $autor->cedula    =  $data['cedula'];
            $autor->nombre    =  $data['nombre'];
            $autor->apellido  =  $data['apellido'];
            $autor->email     =  $data['email'];
            $autor->telefono  =  $data['telefono'];
            $autor->filiacion =  $data['filiacion'];
            $autor->documentos=  $path;
          // $input = array_filter($data,'strlen');
          // $autor->fill($input);
           // dd($autor);
           $autor->save();
           Session::flash('message','Registro agregado correctamente');
 
          if(isset($data['editar'])){           
            return redirect()->back()->withInput(\Request::except("cedula","nombre","apellido","email","telefono","filiacion","documentos"))->with('facultad_old', $request->facultad_old); 
          }else{
            return redirect()->action('AutorController@index');
           }         
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
        $autor = Autor::find($id);
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
            $autor = Autor::find($id);
            
            Storage::delete($autor->documentos);
            $path = Storage::putFile(null,$request->file('documentos'));            
             
            $input = array_filter($data,'strlen');
            
            $autor->fill($input);
            $autor->documentos=$path;           

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
        $autor = Autor::find($id);
        if(empty($autor))
        {
            Session::flash('danger','Registro no encontrado');
             return redirect()->action('AutorController@index'); 
        }else{
            if(DB::table('autorbook')->where('autor_id',$autor->id)->value('id')){
               Session::flash('danger','No se pudo borrar el Registro debido a que esta siendo utilizado.'); 
            }else{
            Storage::delete($autor->documentos);
            $autor->delete();
            Session::flash('message','Registro borrado sin problemas.');
            } 
            return redirect()->action('AutorController@index'); 
        }
    }

     public function consultar(Request $request, $id)
    {
        $autores = Autor::find($id); 
        $url = storage_path($autores->documentos);
        //dd($url);
        return view('autores/consultar', compact('autores','url'));
    }
}
