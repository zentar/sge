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
