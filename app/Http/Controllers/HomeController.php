<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Book;
use App\Autores;
use App\helpers;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros=Book::get();
        $autores=[];

        foreach ($libros as $libro) {
             $autores = separar_autores($libro->autores);
              $libro->autores = "";
                  foreach($autores as $autors){
                   $autor=Autores::find($autors);
                   $libro->autores .= $autor->nombre." ".$autor->apellido." - ";
                  }
                 if(substr($libro->autores, -2)=='- ') 
                 $libro->autores = substr($libro->autores,0, -2);    
        }
       // dd($libros[0]->autores);       
       // dd($libros);
        return view('home', compact('libros','autores'));
    }
}
