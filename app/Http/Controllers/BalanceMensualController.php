<?php

namespace App\Http\Controllers;

use App\Resuman;
use App\Concepto;
use Carbon\Carbon;
use App\Movimiento;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use PDF;

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
        $mes = (int)date('m'); $year=null; $total_ingresos = 0;
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
        $oingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->Excluir('Si')->orderby('fecha','asc')->get();
        $total_ingresos = $ingresos->sum('monto'); $total_oingresos = $oingresos->sum('monto');
        $rcc = $this->porcentajes($mes,$year,$total_ingresos);
        if ($total_ingresos>0 || $total_oingresos>0) {
            if ($total_oingresos=0) {
                $oingresos = [];
            }
    
            $egresos = Movimiento::MovimientoMensual($mes,$year,'Salida')->orderby('fecha','asc')->get();
            $total_egresos = $egresos->sum('monto');
            $resumen = Resuman::MovimientoMensual($mes,$year)->first();
            $sw = 1;
            $saldo_mes_siguiente = $resumen->saldo_inicial + $total_ingresos + $total_oingresos - $total_egresos;
            return view('balance',
                compact('sw','ingresos','egresos','meses','years','mes','year','total_ingresos','total_egresos',
                        'resumen','oingresos','total_oingresos','rcc','saldo_mes_siguiente')
                    );
        }else {
            $request->session()->flash('flash_message', 'No hay registros para esta consulta!');
            return back();
        }
    }
    public function porcentajes($mes,$year,$total_ingresos)
    {
        $concepto = Concepto::select('id')->where('nombre','Porcentajes RCC')->first();
        $ofrendas = Concepto::select('id')->where('nombre','Ofrenda de Sabado')->first();
        $tres = Movimiento::MovimientoTerceraSemana($mes,$year,'Entrada',$ofrendas->id)->orderby('fecha','asc')->get();
        if ($total_ingresos>0 && $tres->count()>2) {
            $pregunta = Movimiento::MovimientoMensual($mes,$year,'Salida')->where('idconcepto',$concepto->id)->Excluir('No')->get();
            
    
            $suma_ingresos = $total_ingresos-$tres[2]->monto;
    
            $rcc['diocesis'] = 0.3*$suma_ingresos;
            $rcc['nacional'] = $tres[2]->monto;
            $rcc['sacerdotes'] = 0.5*$suma_ingresos;
            $rcc['zona'] = 0.15*$suma_ingresos;
            $rcc['total'] = $suma_ingresos*(0.95)+$tres[2]->monto;
            if ($pregunta->count()==0) {
                $fecha = Carbon::createFromDate($year, $mes+1, 1)->sub(1, 'days');
                Movimiento::create([
                    'monto'=>$rcc['total'],
                    'fecha'=>$fecha->format('Y-m-d'),
                    'tipo'=>'Salida',
                    'idconcepto'=>$concepto->id,
                    'excluir'=>0,
                ]);
            }
        }else{
            $rcc['diocesis'] = 0;
            $rcc['nacional'] = 0;
            $rcc['sacerdotes'] = 0;
            $rcc['zona'] = 0;
            $rcc['total'] = 0;
        }
        return $rcc;
    }
    public function cierre(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $day = '1';
        $month_actual = date('m');
        $year_actual = date('Y');
        $cerrado = $request->get('cerrado');
        $fecha  = Carbon::createFromDate($year, $month, $day);
        $fecha_next = $fecha->addMonth();
        $year_next = $fecha_next->year;
        $month_next = $fecha_next->month;
        if ($month_actual>$month && $year_actual>=$year && !$cerrado) {
            Resuman::where('year',$year)->where('month',$month)->update([
                'ingresos'=> $request->get('ingresos'),
                'egresos'=> $request->get('egresos'),
                'saldo_final'=> $request->get('saldo_final'),
                'cerrado'=> 1,
                ]);
            Resuman::create([
                'year'=> $year_next,
                'month'=> $month_next,
                'saldo_inicial'=> $request->get('saldo_final'),
            ]);
            $mensaje = 'Caja Cerrada';
        }else{
            $mensaje = 'No se puede cerrar la caja porque no ha finalizado el mes o la caja ha sido cerrada';
        }
        $request->session()->flash('flash_message',$mensaje);
        return back();
    }
    public function reporte()
    {
        PDF::SetTitle('FICHA DE INSCRIPCION');
        PDF::AddPage('U','A4');
        PDF::SetAutoPageBreak(false);
        #EXPORTO
        PDF::Output(public_path('storage/').'2019_05.pdf','FI');
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
        $anio = arsort($years);
        return ['meses'=>$meses,'years'=>$years];
    }
}
