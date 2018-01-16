<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ReportesController extends Controller
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
     $libros = \App\Book::all();
     $estados = \App\Estados::all();
     return view("reportes/index",compact('libros','estados'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        if($data['libro_id'] == "null")$data['libro_id']=null; 
         if($data['tipo_id'] == "null")$data['tipo_id']=null; 
         $rules = array(
           "libro_id" => 'required',
           "tipo_id" => 'required'     
        );
         
        $v = Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
          $libro = \App\Book::find($data['libro_id']);
          // dd($libro->caracteristicas->tamanopapel);
          $autores = "";

          foreach($libro->autor as $autor){
           $autores .= $autor->nombre." ".$autor->apellido;
          if($autor == $libro->autor->last())
            $autores .="."; 
          else
          $autores .=", "; 
         }

        if($data['tipo_id'] == 'xlsx'){

          \Excel::create('ReporteEspecifico', function($excel)  use ($libro,$autores) {
                    $excel->sheet('Libros', function($sheet) use ($libro,$autores) {                
                        $sheet->loadView('reportes/ReporteEspecifico',array('libro'=>$libro,'autores'=>$autores));                
                    });                
                })->download('xlsx');
        }
        else {
             $pdf = \PDF::loadView('reportes/ReporteEspecifico',['libro'=>$libro,'autores'=>$autores]);
            return $pdf->download('ReporteEspecifico.pdf'); 
            }    
        }
    }

public function create_general(Request $request){
    $data = $request->all();

        if($data['estado_id'] == "null")$data['estado_id']=null; 
         if($data['tipo_id'] == "null")$data['tipo_id']=null; 
         $rules = array(         
           "tipo_id" => 'required',
           "desde" =>'required',
           "hasta" => 'required'
        );
         
        $v = Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }
        else{
     $estado = $data['estado_id'];       
     $desde = $data['desde'];
     $hasta = $data['hasta'];


     if($estado != null){
         $libros = \App\Book::where("created_at",">=",date($data['desde']))->where("created_at","<=",date($data['hasta']))->where("estados_id","=",$estado)->get();  
     }else{
       $libros = \App\Book::where("created_at",">=",date($desde))->where("created_at","<=",date($hasta))->get();
     }
 
        if($data['tipo_id'] == 'xlsx'){

          \Excel::create('ReporteGeneral', function($excel)  use ($libros) {
                    $excel->sheet('Libros', function($sheet) use ($libros) {                
                        $sheet->loadView('reportes/ReporteGeneral',array('libros'=>$libros));                
                    });                
                })->download('xlsx');
        }
        else {
             $pdf = \PDF::loadView('reportes/ReporteGeneralPDF',['libros'=>$libros]);
            return $pdf->download('ReporteGeneral.pdf'); 
            }           
        }  
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
