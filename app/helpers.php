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

//GUARDA ACCION EN TABLA AUDITORIA
function auditoria($titulo,$entidad,$accion,$descripcion,$tipo){
     $auditoria = new App\Auditoria; 
     $auditoria->titulo = $titulo;
     $auditoria->entidad = $entidad;
     $auditoria->accion = $accion;
     $auditoria->descripcion = $descripcion;
     $auditoria->tipo = $tipo;
     $auditoria->ip = \Request::ip();
     $auditoria->pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
     $auditoria->user_id = \Auth::User()->name;
     $auditoria->role_id = \Auth::User()->role->title;
     $auditoria->save();
}
