<?php

namespace App\Http\Controllers;

use App\Concepto;
use App\Actividad;
use App\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MovimientoController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::where('actividad',0)->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $actividades = [];
        return view('movimientos',compact('conceptos','actividades'));
    }
    public function indexa()
    {
        $conceptos = Concepto::where('actividad',1)->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $actividad = Actividad::orderBy('nombre','asc')->select('nombre','fecha','id')->get();
        $actividades = [];
        foreach ($actividad as $key => $value) {
            $nombre = $value->nombre.' - '.$value->fecha;
            $actividades = Arr::add($actividades, $value->id, $nombre);
        }
        return view('movimientos',compact('conceptos','actividades'));
    }
    public function create(Request $request)
    {
        Movimiento::create($request->all());
        return redirect()->route('caja.dashboard');        
    }
}
