<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use DB;
use Session;
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
        
     $libros = \App\Libro::orderBy('titulo', 'asc')->get();
     $estados = \App\Estados::all();
     $colecciones = \App\Coleccion::orderBy('titulo', 'asc')->get();
     $facultades = \App\Facultad::all();


     //GRAFICO ESTADO POR LIBRO 
     $grafico_data =[];
     $data =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and estados_id in (select id from estados) group by estados_id order by estados_id;');
     
         foreach($data as $dato){
             $grafico_data[$dato->estados_id] =  $dato->cantidad;
         }

         for($j=1;$j<=7;$j++){
            if(!isset($grafico_data[$j]))   
            $grafico_data[$j] = "";
         }

       //  dd($data,$grafico_data);

 
     return view("reportes/index",compact('libros','estados','colecciones','facultades','grafico_estados','grafico_data'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (! Gate::allows('reportes_create_especifico')) {
            return abort(403);
        }

        $data = $request->all();
      //  dd($data);
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
          $libro = \App\Libro::find($data['libro_id']);
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
             $pdf = \PDF::loadView('reportes/ReporteEspecificoPDF',['libro'=>$libro,'autores'=>$autores]);
            return $pdf->download('ReporteEspecifico.pdf'); 
            }    
        }
    }

public function create_general(Request $request){

    if (! Gate::allows('reportes_create_general')) {
        return abort(401);
    }

    $data = $request->all();
    
        if($data['coleccion_id'] == "null")$data['coleccion_id']=null; 
        if($data['estado_id'] == "null")$data['estado_id']=null; 
        if($data['tipo_id'] == "null")$data['tipo_id']=null; 
        if($data['facultad_id'] == "null")$data['facultad_id']=null; 

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
     $facultad = $data['facultad_id'];
     $estado = $data['estado_id']; 
     $coleccion = $data['coleccion_id'];      
     $desde = $data['desde'];
     $hasta = $data['hasta'];


    if($estado != null){
        if($coleccion != null){
            if($facultad != null){
                $libros = \App\Libro::where("created_at",">=",date($data['desde']))->where("created_at","<=",date($data['hasta']))->where("estados_id","=",$estado)->where("coleccion_id","=",$coleccion)->where("facultad_id","=",$facultad)->get();  
            }else{
                $libros = \App\Libro::where("created_at",">=",date($data['desde']))->where("created_at","<=",date($data['hasta']))->where("estados_id","=",$estado)->where("coleccion_id","=",$coleccion)->get();  
            }
        }else{
            if($facultad != null){
          $libros = \App\Libro::where("created_at",">=",date($data['desde']))->where("created_at","<=",date($data['hasta']))->where("estados_id","=",$estado)->where("facultad_id","=",$facultad)->get();  
            }else{
                $libros = \App\Libro::where("created_at",">=",date($data['desde']))->where("created_at","<=",date($data['hasta']))->where("estados_id","=",$estado)->get();  
            }
        }
     }else{
        if($coleccion != null){
            if($facultad != null){
            $libros = \App\Libro::where("created_at",">=",date($desde))->where("created_at","<=",date($hasta))->where("coleccion_id","=",$coleccion)->where("facultad_id","=",$facultad)->get();
            }else{
            $libros = \App\Libro::where("created_at",">=",date($desde))->where("created_at","<=",date($hasta))->where("coleccion_id","=",$coleccion)->get();
            }
        }else{
            if($facultad != null){
          $libros = \App\Libro::where("created_at",">=",date($desde))->where("created_at","<=",date($hasta))->where("facultad_id","=",$facultad)->get();
        }else{
            $libros = \App\Libro::where("created_at",">=",date($desde))->where("created_at","<=",date($hasta))->get();
          }
        } 
    }

      if(count($libros)>0){   
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
        }else{
            Session::flash('danger','No existen registros'); 
        }
        return redirect()->back();      
    }  
}


    public function create_grafico(Request $request)
    {
        $datos = $request->all();
        
       // dd($datos);
       if($datos['coleccion'] == "null")$datos['coleccion']=null; 
       if($datos['estado'] == "null")$datos['estado']=null; 
       if($datos['facultad'] == "null")$datos['facultad']=null; 
       if($datos['desde'] == "")$datos['desde']=null; 
       if($datos['hasta'] == "")$datos['hasta']=null; 

        $facultad = $datos['facultad'];
        $estado = $datos['estado']; 
        $coleccion = $datos['coleccion']; 

        $desde = $datos['desde'];
        $hasta = $datos['hasta'];

       // var_dump(  $facultad,$estado,$coleccion,$desde, $hasta);
      // var_dump( DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and facultad_id =3 and estados_id = 3 and coleccion_id=1 group by estados_id order by estados_id;'));
        
        if($estado != null){
            if($coleccion != null){
                if($facultad != null){
                    if($desde != null){
                        if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and estados_id = '.$estado.' and coleccion_id='.$coleccion.' group by estados_id order by estados_id;'); 
                        }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and facultad_id ='.$facultad.' and estados_id = '.$estado.' and coleccion_id= '.$coleccion.' group by estados_id order by estados_id;'); 
                        }
                    }else{
                        if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and estados_id = '.$estado.' and coleccion_id= '.$coleccion.' group by estados_id order by estados_id;'); 
                        }else{
                             $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and facultad_id ='.$facultad.' and estados_id = '.$estado.' and coleccion_id='.$coleccion.' group by estados_id order by estados_id;
                            ');                           
                        }
                }       
                }else{
                   if($desde != null){
                     if($hasta != null){
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and estados_id = '.$estado.' and coleccion_id='.$coleccion.' group by estados_id order by estados_id;');                    
                    }else{
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and estados_id = '.$estado.' and coleccion_id='.$coleccion.' group by estados_id order by estados_id;');                    
                    }
                    }else{
                      if($hasta != null){
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at <= "'.$hasta.'" and estados_id = '.$estado.' and coleccion_id='.$coleccion.' group by estados_id order by estados_id;');                    
                    }else{
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and estados_id = '.$estado.' and coleccion_id='.$coleccion.' group by estados_id order by estados_id;');
                    }
                }
              }
            }else{
                if($facultad != null){
                    if($desde != null){
                        if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and estados_id = '.$estado.' group by estados_id order by estados_id;
                            ');  
                         }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and facultad_id ='.$facultad.' and estados_id = '.$estado.' group by estados_id order by estados_id;
                            ');  
                       }
                       }else{
                         if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and estados_id = '.$estado.' group by estados_id order by estados_id;
                            '); 
                       }else{
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and facultad_id ='.$facultad.' and estados_id = '.$estado.' group by estados_id order by estados_id;
                        ');   
                    }
                   }
                }else{
                    if($desde != null){
                        if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and estados_id = '.$estado.' group by estados_id order by estados_id;');       
                         }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at >= "'.$desde.'" and estados_id = '.$estado.' group by estados_id order by estados_id;');               
                       }
                       }else{
                         if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at <= "'.$hasta.'" and estados_id = '.$estado.' group by estados_id order by estados_id;');         
                       }else{                        
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and estados_id = '.$estado.' group by estados_id order by estados_id;');  
                    }
                   } 
                }
            }
         }else{
             /*PIPO*/ 
            if($coleccion != null){
                if($facultad != null){
                    if($desde != null){
                        if($hasta != null){     
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');     
                        }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at >= "'.$desde.'" and facultad_id ='.$facultad.' and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');     
                            }
                       }else{
                         if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');     
                             }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and facultad_id ='.$facultad.' and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');                           
                            }
                   } 
 
                }else{
                    if($desde != null){
                        if($hasta != null){     
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');   
                        }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at >= "'.$desde.'" and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');   
                        }
                       }else{
                         if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at <= "'.$hasta.'" and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');                 
                        }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and coleccion_id='.$coleccion.' and estados_id in (select id from estados) group by estados_id order by estados_id;');     
                        }
                   } 
                }
            }else{
                if($facultad != null){
                    if($desde != null){
                        if($hasta != null){     
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and estados_id in (select id from estados) group by estados_id order by estados_id;
                            '); 
                        }else{
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at >= "'.$desde.'" and facultad_id ='.$facultad.' and estados_id in (select id from estados) group by estados_id order by estados_id;
                            ');
                        }
                       }else{
                         if($hasta != null){
                            $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and created_at <= "'.$hasta.'" and facultad_id ='.$facultad.' and estados_id in (select id from estados) group by estados_id order by estados_id;
                            ');                          
                        }else{
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros  where deleted_at is null and facultad_id ='.$facultad.' and estados_id in (select id from estados) group by estados_id order by estados_id;
                            '); 
                        }
                   } 
            }else{
                if($desde != null){
                    if($hasta != null){     
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null  and created_at >= "'.$desde.'" and created_at <= "'.$hasta.'" and estados_id in (select id from estados) group by estados_id order by estados_id;');
                         
                    }else{
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null  and created_at >= "'.$desde.'" and estados_id in (select id from estados) group by estados_id order by estados_id;');
                  
                        
                    }
                   }else{
                     if($hasta != null){
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and created_at <= "'.$hasta.'" and estados_id in (select id from estados) group by estados_id order by estados_id;');
                  
                                                
                    }else{
                        $sql =  DB::select('Select estados_id, count(*) as cantidad from libros where deleted_at is null and estados_id in (select id from estados) group by estados_id order by estados_id;');       
                    }
               } 
            }
            } 
        }



        $grafico_data =[];
       
            foreach($sql as $dato){
                $grafico_data[$dato->estados_id] =  $dato->cantidad;
            }
   
            for($j=1;$j<=7;$j++){
               if(!isset($grafico_data[$j]))   
               $grafico_data[$j] = "";
            }

        $data = [[
            "label"=> 'Ingresado',
            "backgroundColor"=> "rgba(255,153,0,0.4)",
            "data"=> [$grafico_data[1]],
            "fill"=>false,
            "datalabels"=>[
              "anchor"=>'center',
              "align"=>'top',
              "color"=>"rgba(0,0,0,1)",
              "font"=>[
                "size"=> 17,
                "style"=>"bold",
              
              ]
            ],
        ],[
            "label"=> 'Aprobado',
            "backgroundColor"=> "rgba(39,165,161,1)",
            "data"=> [$grafico_data[2]],
            "fill"=>false,
            "datalabels"=>[
              "anchor"=>'center',
              "align"=>'top',
              "color"=>"rgba(0,0,0,1)",
              "font"=>[
                "size"=> 17,
                "style"=>"bold",
              
              ]
            ],
        ],[
            "label"=> 'Edición',
            "backgroundColor"=> "rgba(30, 30, 102,0.72)",
            "data"=> [$grafico_data[3]],
            "fill"=>false,
            "datalabels"=>[
              "anchor"=>'center',
              "align"=>'top',
              "color"=>"rgba(0,0,0,1)",
              "font"=>[
                "size"=> 17,
                "style"=>"bold",
              
              ]
            ],
        ],[
            "label"=> 'Cotización',
            "backgroundColor"=> "rgba(253,163,0,0.7)",
            "data"=> [$grafico_data[4]],
            "fill"=>false,
            "datalabels"=>[
              "anchor"=>'center',
              "align"=>'top',
              "color"=>"rgba(0,0,0,1)",
              "font"=>[
                "size"=> 17,
                "style"=>"bold",
              
              ]
            ],
        ], [
            "label"=> 'Aprobado Cotización',
            "backgroundColor"=> "rgba(0,255,0,0.3)",
            "data"=> [$grafico_data[5]],
            "fill"=>false,
            "datalabels"=>[
              "anchor"=>'center',
              "align"=>'top',
              "color"=>"rgba(0,0,0,1)",
              "font"=>[
                "size"=> 17,
                "style"=>"bold",
              
              ]
            ],
        ],[
            "label"=> 'Producción',
            "backgroundColor"=> "rgba(205, 29, 29,0.7)",
            "data"=> [$grafico_data[6]],
            "fill"=>false,
            "datalabels"=>[
              "anchor"=>'center',
              "align"=>'top',
              "color"=>"rgba(0,0,0,1)",
              "font"=>[
                "size"=> 17,
                "style"=>"bold",
              
              ]
            ],
        ], [
            "label"=> 'Publicado',
            "backgroundColor"=> "rgba(164, 29, 205,0.5)",
            "data"=> [$grafico_data[7]],
            "fill"=>false,
            "datalabels"=>[
              "anchor"=>'center',
              "align"=>'top',
              "color"=>"rgba(0,0,0,1)",
              "font"=>[
                "size"=> 17,
                "style"=>"bold",
              
              ]
            ],
        ]];

         $options = [
            // legendCallback: function(chart) {},
              "responsive"=> true,
              "animation"=> [
                      "duration"=> 0,
              ],  
              "title"=> [
                   "display"=> true,
                "text"=> 'Cantidad de Libros por estado',
              ],
          
              "legend"=> [
                "display"=> true,
                "position"=> 'top',
                "labels"=> [
                  "fontColor"=> "#000080",          
                ],
            
            //   DESHABILITA OPCION DE CLICK EN LEGENDA DE LA IMAGEN    
               "onClick"=> "function (e) [
                  e.stopPropagation();
               ]",
          
            ],
          
 "scales"=> [
  "xAxes"=> [[   
        "stacked"=> false,
            "beginAtZero"=> true,
      "ticks"=> [
        "min"=> 0,
             "autoSkip"=> false
      ],
         "position"=> 'bottom',
                  
            "scaleLabel"=> [
           "display"=> true,
               "labelString"=> 'Estados'
            ],
                    "categoryPercentage"=> 1.0,
               "barPercentage"=> 0.6,
                ]],
                "yAxes"=> [[
               
                    "stacked"=> false,
                    "beginAtZero"=> true,
                    "ticks"=> [
                      "min"=> 0,
                      "beginAtZero"=> true
                    ],
                    "position"=> 'left',
                   
                     "scaleLabel"=> [
                       "display"=> true,
                       "labelString"=> 'Cantidad de Libros'
                     ],
                     "categoryPercentage"=> 1.0,
                     "barPercentage"=> 0.6,
                ]]
            ],
          
            "tooltips"=>[
                     "callbacks"=> [
                   "title"=> "function() {}"
                   ],
            ],
        ];   

 
        return response()->json([ 
            "type"=> 'bar',  
            "data"=>  ["labels"=> ["Ingresado", "Aprobado", "Edición", "Cotización", "Aprobado Cotización", "Producción","Publicado"], 
            "datasets"=>$data],
          
            "options"=> $options  
        ]);
    
    }

   
}
