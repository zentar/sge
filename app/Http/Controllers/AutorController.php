<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Autor;
use App\autorbook;
use App\Tipodoc;
use App\File;
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
      // dd($autores[0]->file);
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
        //dd($data);
        $rules = array(
        'cedula' => 'required|digits:10|unique:autors,cedula',
        'nombre' => 'required|max:85',
        'apellido' => 'required|max:85',
        'email' => 'required|email|unique:autors,email',
        'telefono' => 'required|digits:7'
        );
        
        if($data['filiacion']==null)$data['filiacion']='-';

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
           $autor->save();

           crearDirectorio('autor',$autor);           

           Session::flash('message','Autor ingresado correctamente');
 
          if(isset($data['editar'])){           
            return redirect()->back()->withInput(\Request::except("cedula","nombre","apellido","email","telefono","filiacion"))->with('facultad_old', $request->facultad_old)->with('coleccion_old', $request->coleccion_old)->with('modal_autor', 1); 
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
            'cedula' => 'required|digits:10',
            'nombre' => 'required|max:85',
            'apellido' => 'required|max:85',
            'email' => 'required|email',
            'telefono' => 'required|digits:7'
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
             
            $input = array_filter($data,'strlen');
            
            $autor->fill($input);
                    

            $autor->save();
            Session::flash('message','Autor editado correctamente');
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
               Session::flash('danger','No se pudo borrar el Autor debido a que esta siendo utilizado.'); 
            }else{
          // Storage::delete($autor->documentos);
            $autor->delete();
            Session::flash('message','Registro borrado sin problemas.');
            } 
            return redirect()->action('AutorController@index'); 
        }
    }

     public function consultar(Request $request, $id)
    {
        $autores = Autor::find($id);
        return view('autores/consultar', compact('autores'));
    }

    public function editarDocumentos(Request $request, $id)
    {
      $tipos = Tipodoc::get()->where('grupo','autor');
      $autor = Autor::with('file.tipodoc')->get()->first();
      return view('autores/documentos', compact('tipos','autor'));
    }
}
