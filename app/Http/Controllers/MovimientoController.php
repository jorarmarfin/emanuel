<?php

namespace App\Http\Controllers;

use App\Concepto;
use App\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::pluck('nombre','id')->toarray();
        return view('movimientos',compact('conceptos'));
    }
    public function setmovimiento(Request $request)
    {
        Movimiento::create($request->all());
        return view('home');        
    }
}
