<?php

namespace App\Http\Controllers;

use App\Deuda;
use App\Resuman;
use App\Movimiento;
use Illuminate\Http\Request;

class DashboardCajaController extends Controller
{
    public function index()
    {
        $movimientos = Movimiento::orderby('fecha','asc')->get();
        $resumen = Resuman::orderBy('year','desc')->orderBy('month','desc')->first();
        $xcobrar = Deuda::where('estado','por cobrar')->get();
        $xpagar = Deuda::where('estado','por pagar')->get();
        $total_xcobrar = number_format($xcobrar->sum('monto'),2);
        $total_xpagar = number_format($xpagar->sum('monto'),2);
        return view('dashboard.caja',compact('movimientos','resumen','xcobrar','total_xcobrar','xpagar','total_xpagar'));
    }
}
