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
        $mes = date('m');
        $year = date('Y');
        $ingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->whereNull('idactividad')->Excluir('No')->orderby('fecha','asc')->get();
        $oingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->whereNull('idactividad')->Excluir('Si')->orderby('fecha','asc')->get();
        $egresos = Movimiento::MovimientoMensual($mes,$year,'Salida')->whereNull('idactividad')->orderby('fecha','asc')->get();
        $caja = $resumen->saldo_inicial + $ingresos->sum('monto') + $oingresos->sum('monto') - $egresos->sum('monto');
        return view('dashboard.caja',compact('movimientos','caja','xcobrar','total_xcobrar','xpagar','total_xpagar'));
    }
}
