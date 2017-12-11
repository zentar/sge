<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autor;

class ImageController extends Controller
{
   public function show($id)
    {          
        $autores = Autor::find($id); 
        $image = storage_path('app/'.$autores->documentos);
        return \Image::make($image )->response();
    }
}
