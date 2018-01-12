<?php

use Illuminate\Http\Request;


function separar_autores($autores)
{
     $data = explode(";", $autores);
     return $data;

}


function quitar_capitulos_eliminados($cuerpos,$eliminados)
{
    for($i=1;$i<count($eliminados);$i++)
    unset($cuerpos['capitulo'.$eliminados[$i]]);
    return $cuerpos;
}

    function crearDirectorio($tipo, $libro){

     if($tipo=='libro'){	   
	    $folder = 'libro' . $libro->id;
        Storage::makeDirectory('/libros/'.$folder);
      }
      else{
        $folder = 'autor' . $libro->id;
        Storage::makeDirectory('/autor/'.$folder);
    }
}

function valorPredeterminado($valor){
  if(isset($valor))
  return $valor;
  else
  return "-";
}

//GUARDA ACCION EN TABLA HISTORIAL
function historial($descripcion,$book_id){
        $historial = new \App\Historial;
        $historial->descripcion = $descripcion;
        $historial->book_id = $book_id;
        $historial->save();   

}

//REALIZA UN ARREGLO CON LOS ID DE LOS DOCUMENTOS INGRESADOS PARA FILTRARLOS EN LA CONSULTA WHERENOTIN
function filtrar_documentos_ingresados($libro){
    $doc_no_ingresados=[];  
   foreach($libro->file as $documentos){
    $otros =  DB::table('tipodoc')->where([['grupo', '=', 'libro']])->where([['nombre', '=', 'Otros']])->get()->first()->id;   
    if($documentos->tipodoc_id !=  $otros){
      array_push($doc_no_ingresados,$documentos->tipodoc_id);
    }
}
 return $doc_no_ingresados;   
}