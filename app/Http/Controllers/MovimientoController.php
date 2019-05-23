<?php

namespace App\Http\Controllers;

use App\Resuman;
use App\Concepto;
use App\Actividad;
use Carbon\Carbon;
use App\Movimiento;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

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
        $fecha = Carbon::createFromFormat('Y-m-d',$request->get('fecha'));
        $resumen = Resuman::MovimientoMensual($fecha->month,$fecha->year)->first();
        if (!$resumen->cerrado) {
            Movimiento::create($request->all());
            return redirect()->route('caja.dashboard');  
        }else{
            $mensaje = 'La caja ya esta cerrada para esta fecha';
            $request->session()->flash('flash_message',$mensaje);
            return back();              
        }
    }
}
