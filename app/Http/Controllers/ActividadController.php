<?php

namespace App\Http\Controllers;

use App\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function lista()
    {
        $actividades = Actividad::orderby('fecha','desc')->get();
        return view('actividad-lista',compact('actividades'));
    }
    public function balance($idactividad)
    {
        dd($idactividad);
    }
}
