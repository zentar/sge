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

//CREA CARPETA DE LIBRO O AUTOR EN CASO DE NO EXISTIR
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

// COLOCA DE VALOR PREDETERMINADO UN - SI EL VALOR NO ESTA SETEADO
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

//COMPRUEBA QUE LOS REGISTROS DE LOS DOCUMENTOS PERTENECIENTES AL ISBN O IEPI EXISTAN RESPECTIVAMENTE 
function permisos_isbn_iepi($libro,$tipo){

 //dd($libro->file[0]->tipodoc_id);

 //dd($tipos);

  if($tipo == "isbn"){
    $tipos = [];
    foreach($libro->file as $file){
         if($file->tipodoc_id == 4 || $file->tipodoc_id == 5 || $file->tipodoc_id ==  6)
         array_push($tipos,$file->tipodoc_id);
    }
    
    if(count($tipos) == 3)
    return 1;
      else
    return 0;
  }elseif($tipo == "iepi"){
    $tipos = [];
    foreach($libro->file as $file){
         if($file->tipodoc_id == 8 || $file->tipodoc_id == 9 || $file->tipodoc_id ==  10)
         array_push($tipos,$file->tipodoc_id);
    }
    
    if(count($tipos) == 3)
    return 1;
      else
    return 0;

  }
}

function reporte_cotizacion($libro,$cotizaciones){
  $tipoLetra = "Cambria (Títulos)";         
  //PRUEBA CREACION WORD DOC          
  $phpWord = new \PhpOffice\PhpWord\PhpWord();

   //COLOCA EL DOCUMENTO EN ESPAÑOL
   $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));
   
   //MARGENES DE LA PAGINA EN TWIP
   $section = $phpWord->addSection(array('marginLeft' => 2267.716535433, 'marginRight' => 1700.787401575,
   'marginTop' => 1984.251968504, 'marginBottom' => 1315.275590551));

   // AÑADE CABECERA
      $header = $section->createHeader();
   $table = $header->addTable();
   $table->addRow();
   $table->addCell(5000)->addImage(public_path('logoNormal.png'), array('width'=>160, 'height'=>45, 'align'=>'left'));
   $table->addCell(5000)->addImage(public_path('LogoUCSG.png'), array('width'=>113, 'height'=>56, 'align'=>'right'));

   
   // AÑADE PIE DE PAGINA
   $footer = $section->createFooter();
   $footer->addLine(['weight' => 1, 'width' => 415, 'height' => 0]);
   $footer->addPreserveText('Av .C.J. Arosemena Km. 1,5 Edificio principal, segundo piso. Apartado postal 09-01-4671 Guayaquil – Ecuador
   Telefax: 593-04-2209210 Ext. 2634 Correo electrónico: roberto.garcia02@cu.ucsg.edu.ec
   ', array('name' => 'Arial Narrow', 'size' => 9), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);


   // CONSIGUE LA FECHA DE HOY EN ESPAÑOL PARA EL ENCABEZADO
   setlocale(LC_TIME, "es_ES", 'Spanish_Spain', 'Spanish');
   $fecha_hoy = \Carbon\Carbon::now();
   $mes = iconv('ISO-8859-2', 'UTF-8', strftime("%B de %Y", strtotime($fecha_hoy)));
   $fecha = iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime($fecha_hoy)));

   //PARRAFO
   $section->addText('No. 001 ',array('bold'=>true,'name' => $tipoLetra, 'size' => 10), ['align'=>'right','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $section->addText('Guayaquil, '.$fecha,array('name' => $tipoLetra, 'size' => 10), ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $section->addText('PRODUCCIÓN DE LA OBRA: ', array('name' => $tipoLetra, 'size' => 10,'bold'=>true), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $section->addText($libro->titulo, array('name' => $tipoLetra, 'size' => 10,'bold'=>true), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $section->addText('Cotización solicitada, en mes de '.$mes.', de acuerdo con las siguientes características:', array('name' => $tipoLetra, 'size' => 10), [ 'align' => 'both' ]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   
   $titulo = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $titulo->addText('Título: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $titulo->addText($libro->titulo,array('name' => $tipoLetra, 'size' => 10));

   $autores = "";

   foreach($libro->autor as $autor){
    $autores .= $autor->nombre." ".$autor->apellido;
    if($autor == $libro->autor->last())
        $autores .="."; 
    else
    $autores .=", "; 
   }
   $autor = $autores;
   $tipo_papel = \App\TamanoPapel::find($libro->caracteristicas->tamano)->descripcion;

   //CARACTERISTICAS
   $autores = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $autores->addText('Autores: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $autores->addText($autor,array('name' => $tipoLetra, 'size' => 10));

   $tamano = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $tamano->addText('Tamaño: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $tamano->addText($tipo_papel,array('name' => $tipoLetra, 'size' => 10));

   $papel = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $papel->addText('Papel: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $papel->addText($libro->caracteristicas->tipopapel->descripcion,array('name' => $tipoLetra, 'size' => 10));

   $paginas = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $paginas->addText('Número de páginas: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $paginas->addText($libro->caracteristicas->n_paginas,array('name' => $tipoLetra, 'size' => 10));

   $color = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $color->addText('Color: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $color->addText($libro->caracteristicas->colorpapel->descripcion,array('name' => $tipoLetra, 'size' => 10));

   $cubierta = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $cubierta->addText('Cubierta: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $cubierta->addText($libro->caracteristicas->cubierta,array('name' => $tipoLetra, 'size' => 10));

   $solapas = $section->addTextRun( [ 'align' => 'both','spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $solapas->addText('Solapas: ', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $solapas->addText($libro->caracteristicas->solapas,array('name' => $tipoLetra, 'size' => 10));

   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
 //  $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);

   $header = array('size' => 16, 'bold' => true,'alignment'=>'both');
 //  $section->addText('Cotizaciones', $header, [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER ]);

   $phpWord->addTableStyle('Estilo Cotizacion', array('borderSize' => 6, 'borderColor' => '#000000', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));

   $table = $section->addTable('Estilo Cotizacion');
   
   //CABECERA DE TABLA
   $table->addRow();
   $table->addCell(5000)->addText("IMPRENTA",array('bold'=>true,'name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0 ]);
   $table->addCell(5000)->addText("TIRAJE",array('bold'=>true,'name' => $tipoLetra, 'size' => 10),  [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
   $table->addCell(5000)->addText("VALOR ($)",array('bold'=>true,'name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
   $table->addCell(5000)->addText("TOTAL ($)", array('bold'=>true,'name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);   
  // $table->addCell(5000)->addText(null, array('bold'=>true,'name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);   

   $i=1;
   foreach($cotizaciones as $cotizacion){          
   $table->addRow();
   $table->addCell(5000)->addText($cotizacion->imprenta,array('name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0 ]);
   $table->addCell(5000)->addText($cotizacion->tiraje." ejemplares",array('name' => $tipoLetra, 'size' => 10),  [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
   $table->addCell(5000)->addText("$".$cotizacion->valor,array('name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
   $table->addCell(5000)->addText("$".$cotizacion->total, array('name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);
   $table->addCell(5000)->addText(null, array('name' => $tipoLetra, 'size' => 10), [ 'align' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,'spaceAfter' => 0  ]);

   $i++;
   }
   

   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);           
   $section->addText('Observaciones:', array('bold'=>true,'name' => $tipoLetra, 'size' => 10));
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);

   $section->addText('Considerando la calidad del material, tiempo de entrega, acabados, se selecciona a la Empresa _________________________________________',array('name' => $tipoLetra, 'size' => 10));
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $section->addText('Tramitado por:    			Vto. Bno.			Autorizado',array('name' => $tipoLetra, 'size' => 10),['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $section->addText('_____________			      _________________		          ________________',array('name' => $tipoLetra, 'size' => 10));
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $textrun = $section->addTextBreak(1, null, ['spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)]);
   $section->addText('Se adjunta (5) copia(s) de cotizaciones.',array('name' => $tipoLetra, 'size' => 10));
   $section->addText('SO. Trabajo #..........',array('name' => $tipoLetra, 'size' => 10));
   
   //PARA ID DE GUARDADO DIA MES AÑO SEGUNDO
   $fecha_guardado = iconv('ISO-8859-2', 'UTF-8', strftime("%d%m%Y%S", strtotime($fecha_hoy)));

   $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
   $objWriter->save('ReporteCotizacion.docx');       
       

 return response()->download('ReporteCotizacion.docx','RC'.$libro->titulo.$fecha_guardado.'.docx');

}


 
 

