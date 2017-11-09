<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Book;
use App\Autores;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autores = Autores::all();
        $autores_nombre=[];       
           foreach($autores as $autors){
                    $autores_nombre[$autors->id] = $autors->nombre." ".$autors->apellido;                   
                  }
        return view('libros/create', compact('libro','autores_nombre'));
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
        'titulo' => 'required',
        'autores' => 'required',
        'facultad' => 'required',
        'isbn' => 'required',
        'paginas' => 'required'
        );
        if($data['revision_pares']==null)$data['revision_pares']='-';
        if($data['contrato']==null)$data['contrato']='-';
        if($data['pi']==null)$data['pi']='-';
        //dd($data);

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
           $libro = New Book;
           $input = array_filter($data,'strlen');
           $libro->fill($input);
           $libro->save();
           Session::flash('message','Registro agregado correctamente');
           return redirect()->action('HomeController@index'); 
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
        $libro = Book::find($id);
        $autores = Autores::all();
        $autores_nombre=[];       
           foreach($autores as $autors){
                    $autores_nombre[$autors->id] = $autors->nombre." ".$autors->apellido;                   
                  }
        return view('libros/editar', compact('libro','autores_nombre'));
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
           "titulo" => 'required',
           "facultad" => 'required',
           "isbn" => 'required',
           "paginas" => 'required'
        );

        $v=Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
            $libro = Book::find($id);
            $input = array_filter($data,'strlen');
            $libro->fill($input);
            //dd($libro);
            $libro->save();
            Session::flash('message','Registro editado correctamente');
            return redirect()->action('HomeController@index'); 
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
        $libro = Book::find($id);
        if(empty($libro))
        {
            Session::flash('message','Registro no encontrado');
            return redirect(route('admin.home'));
        }else{
            $libro->delete();
            Session::flash('message','Registro borrado sin problemas.');
            return redirect(route('admin.home')); 
        }
       
    }

       public function consultar(Request $request, $id)
    {
        $libro = Book::find($id);
        //$autores = Autores::find($libro->autores);

           $autores = separar_autores($libro->autores);
              $libro->autores = "";
                  foreach($autores as $autors){
                   $autor=Autores::find($autors);
                   $libro->autores .= $autor->nombre." ".$autor->apellido." - ";
                  }
                 if(substr($libro->autores, -2)=='- ') 
                 $libro->autores = substr($libro->autores,0, -2);  

        return view('libros/consultar', compact('libro'));
    }

}
