<?php

namespace App\Http\Controllers;

use App\Deuda;
use App\Miembro;
use App\Concepto;
use App\Actividad;
use Illuminate\Http\Request;

class DeudasController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::where('actividad',0)->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $actividades = Actividad::where('activo','si')->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $hermanos = Miembro::orderBy('nombres','asc')->pluck('nombres','id')->toarray();
        $estados = $this->getEstados();
        return view('deudas',compact('conceptos','estados','actividades','hermanos'));
    }
    public function create(Request $request)
    {
        Deuda::create($request->all());
    }
    public function dashboard()
    {
        return view('deudas-dashboard');
    }
    public function getEstados()
    {
        return [
            'por cobrar'=>'Por cobrar',
            'por pagar'=>'Por Pagar',
            'pagado'=>'Pagado',
            'cobrado'=>'Cobrado',
            'por cobrar'=>'Por cobrar',
        ];
    }
}
