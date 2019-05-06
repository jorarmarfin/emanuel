<?php

namespace App\Http\Controllers;

use App\Movimiento;
use Illuminate\Http\Request;

class DashboardCajaController extends Controller
{
    public function index()
    {
        $movimientos = Movimiento::orderby('fecha','asc')->get();
        return view('dashboard.caja',compact('movimientos'));
    }
}
