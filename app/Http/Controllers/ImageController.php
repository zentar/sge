<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autor;
use App\File;

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


   public function show($file)
    {        
        $doc = File::find($file);   
       // dd($doc);
        $image = storage_path('app/'.$doc->ruta.'.'.$doc->extension);      
        return \Image::make($image)->response();
    }

       public function crear_autor(Request $request,$file){
         dd('hola');

       }



}
