<?php

namespace App\Http\Controllers;

use App\Concepto;
use App\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::where('actividad',0)->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        return view('movimientos',compact('conceptos'));
    }
    public function create(Request $request)
    {
        Movimiento::create($request->all());
        return redirect()->route('caja.dashboard');        
    }
}
