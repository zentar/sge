<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Autor;
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
     //   $libros= Book::with(['autor','estados','coleccion'])->get();

    //    $libros = \Auth::User()->book;
     //  dd($libros[0]->mensajes);
      //  return view('home', compact('libros'));
        if(\Auth::User()->role_id == 1){
            $libros= \App\Libro::with(['autor','estados','coleccion'])->whereNotIn('estados_id', [7])->get();
            return view('home', compact('libros'));
        }

        if(\Auth::User()->role_id == 2){
         //   $libros = \Auth::User()->book;
            $libros= \App\Libro::with(['autor','estados','coleccion'])->whereNotIn('estados_id', [7])->get();
            return view('home', compact('libros'));
         }
        
        if(\Auth::User()->role_id == 3){
            $libros = \Auth::User()->libro()->whereNotIn('estados_id', [7])->get();;
            return view('home', compact('libros'));
         }

         if(\Auth::User()->role_id == 4){
             $libros = \Auth::User()->libro()->whereNotIn('estados_id', [7])->get();;
           // $asignados = \Auth::User()->book;
          //  dd($asignados);
          //  $libros = [];
           /* foreach($asignados as $libro){          
              if($libro->pivot->estado == 1){            
                array_push($libros,$libro);
              }
            }  */
            return view('home', compact('libros'));
        }
        // ip \Request::ip();
        // user_name  gethostbyaddr($_SERVER['REMOTE_ADDR']);
        // datos del usuario y roles \Auth::User();        
    }
}
