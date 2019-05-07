<?php

namespace App\Http\Controllers;

use App\Resuman;
use App\Movimiento;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;


class BalanceMensualController extends Controller
{
    public $meses;
    public $years;

    public function __construct() {
        $data = $this->getDatos();
        $this->meses = $data['meses'];
        $this->years = $data['years'];
    }
    public function index()
    {
        
        $meses = $this->meses;
        $years = $this->years;
        $ingresos = [];
        $egresos = [];
        $mes = null; $year=null; $total_ingresos = 0;
        $sw = 0;
        return view('balance',compact('ingresos','egresos','meses','years','mes','year','sw'));
    }
    public function balance(Request $request)
    {
        $mes = $request->get('mes');
        $year = $request->get('year');
        $meses = $this->meses;
        $years = $this->years;
        $ingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->Excluir('No')->orderby('fecha','asc')->get();
        $total_ingresos = $ingresos->sum('monto');
        $oingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->Excluir('Si')->orderby('fecha','asc')->get();
        $total_oingresos = $oingresos->sum('monto');

        $egresos = Movimiento::MovimientoMensual($mes,$year,'Salida')->orderby('fecha','asc')->get();
        $total_egresos = $egresos->sum('monto');
        $resumen = Resuman::MovimientoMensual($mes,$year)->first();
        $sw = 1;
        return view('balance',compact('sw','ingresos','egresos','meses','years','mes','year','total_ingresos','total_egresos',
                    'resumen','oingresos','total_oingresos'));
    }
    public function getDatos()
    {
        $meses = [
            1=>'Enero',
            2=>'Febrero',
            3=>'Marzo',
            4=>'Abril',
            5=>'Mayo',
            6=>'Junio',
            7=>'Julio',
            8=>'Agosto',
            9=>'Setiembre',
            10=>'Octubre',
            11=>'Noviembre',
            12=>'Diciembre',
        ];
        $years = [];
        $anio = date('Y');
        for ($i=2018; $i <= $anio; $i++) { 
            $years = Arr::add($years, $i, $i);
        }
        return ['meses'=>$meses,'years'=>$years];
    }
}
