<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auditoria;
use \Spatie\Activitylog\Models\Activity;
use DB;

class AuditoriaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $activity = Activity::all();
     return view("auditoria/index",compact('activity'));   
    }

  
}
