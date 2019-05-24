<?php

namespace App\Http\Controllers;

use App\Resuman;
use App\Movimiento;
use Illuminate\Http\Request;

class DashboardCajaController extends Controller
{
    public function index()
    {
        $movimientos = Movimiento::orderby('fecha','asc')->get();
        $resumen = Resuman::orderBy('year','desc')->orderBy('month','desc')->first();
        return view('dashboard.caja',compact('movimientos','resumen'));
    }
}
