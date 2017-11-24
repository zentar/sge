<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Book;
use App\Autor;
use App\autorbook;

class LibroController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autores = Autor::all();
        $autores_nombre=[];
        array_push($autores_nombre,"Seleccionar Autor");       
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
        //dd($data);
         $rules = array(
        'titulo' => 'required',
        'autores' => 'required',
        'facultad' => 'required',
        'isbn' => 'required',
        'paginas' => 'required',
        'autor' => 'required',
        );
        if($data['revision_pares']==null)$data['revision_pares']='-';
        if($data['contrato']==null)$data['contrato']='-';
        if($data['pi']==null)$data['pi']='-';

        $v = Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput()->with('error_code', 4);
        }
        else{
           $autores= $data['autor']; 
           unset($data['autor']);
           $libro = New Book;
           $input = array_filter($data,'strlen');
           $libro->fill($input);              
           $libro->save();
           

           foreach($autores as $autor){
            $libroAutor = new autorbook;
            $libroAutor->book_id=$libro->id;
            $libroAutor->autor_id=$autor; 
            $libroAutor->save();
           }

           
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
        $autores = Autor::all();
        $flag_editar_autor=1;
        $autores_nombre=[];
        array_push($autores_nombre,"Seleccionar Autor");  
           foreach($autores as $autors){
                    $autores_nombre[$autors->id] = $autors->nombre." ".$autors->apellido;                   
                  }
      // dd($libro->autor);
        return view('libros/editar', compact('libro','autores_nombre','flag_editar_autor'));
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
       // dd($data);
        $rules = array(
           "titulo" => 'required',
           "facultad" => 'required',
           "isbn" => 'required',
           "autor" => 'required',
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
            $autores= $data['autor']; 
            unset($data['autor']);
            $libro = Book::find($id);
            $input = array_filter($data,'strlen');
            $libro->fill($input);
            $libro->save();

             $eliminar = autorbook::where('book_id', $libro->id);

            if(!$eliminar==null)
            $eliminar->delete();  

        foreach($autores as $autor){                 

            $libroAutor = new autorbook;
            $libroAutor->book_id=$libro->id;
            $libroAutor->autor_id=$autor; 
            $libroAutor->save();
           }
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
        return view('libros/consultar', compact('libro'));
    }

}
