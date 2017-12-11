<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autor;

class ImageController extends Controller
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


   public function show($id)
    {          
        $autores = Autor::find($id); 
        $image = storage_path('app/'.$autores->documentos);
        return \Image::make($image )->response();
    }
}
