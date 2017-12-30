<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Book;
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
        $libros= Book::with(['autor','estados'])->get();
        // dd(\Auth::User()->role);
        // ip \Request::ip();
        // user_name  gethostbyaddr($_SERVER['REMOTE_ADDR']);
        // datos del usuario y roles \Auth::User();
        return view('home', compact('libros'));
    }
}
