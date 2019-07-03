<?php

namespace App\Http\Controllers;

use PDF;
use App\Resuman;
use App\Concepto;
use Carbon\Carbon;
use App\Movimiento;
use App\Porcentaje;
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
        $mes = (int)date('m'); $year=null; $total_ingresos = 0;
        $sw = 0;
        $nombre_mes = '';        
        return view('balance',compact('ingresos','egresos','meses','years','mes','year','sw','nombre_mes'));
    }
    public function balance(Request $request)
    {
        $mes = $request->get('mes');
        $year = $request->get('year');
        $meses = $this->meses;
        $years = $this->years;
        $nombre_mes = $this->getMes($mes);

        $ingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->whereNull('idactividad')->Excluir('No')->orderby('fecha','asc')->get();
        $oingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->whereNull('idactividad')->Excluir('Si')->orderby('fecha','asc')->get();
        $resumen = Resuman::MovimientoMensual($mes,$year)->first();
        if ($ingresos->count()>0) {
            $total_ingresos = $ingresos->sum('monto'); 
        }else{
            $ingresos = [];$total_ingresos = 0;
        }
        if ($oingresos->count()>0) {
            $total_oingresos = $oingresos->sum('monto');
        }else{
            $oingresos = []; $total_oingresos = 0;
        }
        
        if (isset($resumen)) {
            $rcc = $this->porcentajes($mes,$year,$total_ingresos);
            $egresos = Movimiento::MovimientoMensual($mes,$year,'Salida')->whereNull('idactividad')->orderby('fecha','asc')->get();
            if ($egresos->count()>0) {
                $total_egresos = $egresos->sum('monto');
            }else{
                $egresos = []; $total_egresos = 0;
            }
            $saldo_inicial = $resumen->saldo_inicial;
            $saldo_mes_siguiente = $saldo_inicial + $total_ingresos + $total_oingresos - $total_egresos;
            
            $sw = 1;
            
            return view('balance',
                    compact('sw','ingresos','egresos','meses','years','mes','year','total_ingresos','total_egresos',
                            'resumen','oingresos','total_oingresos','rcc','saldo_mes_siguiente','nombre_mes')
                        );
        }else{
            $request->session()->flash('flash_message', 'No hay registros para esta consulta!');
            return back();
        }
    }
    public function porcentajes($mes,$year,$total_ingresos = 0)
    {
        $concepto = Concepto::select('id')->where('nombre','Porcentajes RCC')->first();
        $ofrendas = Concepto::select('id')->where('nombre','Ofrenda de Sabado')->first();
        $tres = Movimiento::MovimientoTerceraSemana($mes,$year,'Entrada',$ofrendas->id)->orderby('fecha','asc')->get();
        $diocesis = Porcentaje::where('nombre','diocesis')->first();
        $zona = Porcentaje::where('nombre','zona')->first();
        $sacerdotes = Porcentaje::where('nombre','sacerdotes')->first();
        if ($tres->count()>=4) {
            $suma_ingresos = $total_ingresos-$tres[2]->monto;
            $rcc['diocesis']['valor'] = $diocesis->valor_p*$suma_ingresos; 
            $rcc['diocesis']['label'] = $diocesis->valor_l;
            $rcc['diocesis']['nombre'] = 'Diocesis';
            $rcc['nacional']['valor'] = $tres[2]->monto;
            $rcc['nacional']['label'] = '3 S';
            $rcc['nacional']['nombre'] = 'Nacional';
            $sacerdotes_tmp = $sacerdotes->valor_p*$suma_ingresos;
            $rcc['sacerdotes']['valor'] = ($sacerdotes_tmp<5) ? 5 : $sacerdotes_tmp ; 
            $rcc['sacerdotes']['label'] = $sacerdotes->valor_l;
            $rcc['sacerdotes']['nombre'] = 'Sacerdotes';
            $rcc['zona']['valor'] = $zona->valor_p*$suma_ingresos; 
            $rcc['zona']['label'] = $zona->valor_l;
            $rcc['zona']['nombre'] = 'Zona';
            $rcc['total'] = $rcc['diocesis']['valor']+$rcc['nacional']['valor']+$rcc['sacerdotes']['valor']+$rcc['zona']['valor'];

            $pregunta = Movimiento::MovimientoMensual($mes,$year,'Salida')->where('idconcepto',$concepto->id)->get();
            if ($pregunta->count()==0) {
                $fecha = Carbon::createFromDate($year, $mes+1, 1)->sub(1, 'days');
                Movimiento::create([
                    'monto'=>$rcc['total'],
                    'fecha'=>$fecha->format('Y-m-d'),
                    'tipo'=>'Salida',
                    'idconcepto'=>$concepto->id,
                    'excluir'=>0,
                ]);
            }else {
                Movimiento::where('id', $pregunta[0]->id)->update(['monto'=>$rcc['total']]);
            }

        }else{

            $rcc['diocesis']['valor'] = 0;
            $rcc['diocesis']['label'] = $diocesis->valor_l;
            $rcc['diocesis']['nombre'] = 'Diocesis';
            $rcc['nacional']['valor'] = 0;
            $rcc['nacional']['label'] = '3 S';
            $rcc['nacional']['nombre'] = 'Nacional';
            $rcc['sacerdotes']['valor'] = 0;
            $rcc['sacerdotes']['label'] = $sacerdotes->valor_l;
            $rcc['sacerdotes']['nombre'] = 'Sacerdotes';
            $rcc['zona']['valor'] = 0;
            $rcc['zona']['label'] = $zona->valor_l;
            $rcc['zona']['nombre'] = 'Zona';
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
            $resumen = Resuman::where('year',$year_next)->where('month',$month_next)->first();
            if (isset($resumen)) {
                Resuman::where('id',$resumen->id)->update([
                    'saldo_inicial'=> $request->get('saldo_final'),
                ]);
                $mensaje = 'Caja Actualizada';
            }else{
                Resuman::create([
                    'year'=> $year_next,
                    'month'=> $month_next,
                    'saldo_inicial'=> $request->get('saldo_final'),
                ]);
                $mensaje = 'Caja Cerrada';
            }
        }else{
            $mensaje = 'No se puede cerrar la caja porque no ha finalizado el mes o la caja ha sido cerrada';
        }
        $request->session()->flash('flash_message',$mensaje);
        return back();
    }
    public function reporte($year,$mes)
    {
        return view('balance-reporte',compact('year','mes'));
    }
    public function pdf($year,$mes)
    {
        PDF::SetTitle('BALANCE MENSUAL');
        
        PDF::SetAutoPageBreak(false);
        $this->pdfIngreso($year,$mes);
        $this->pdfEgreso($year,$mes);
        $archivo = public_path('storage/').$year.'_'.$mes.'.pdf';
        
        #EXPORTO
        PDF::Output($archivo,'FI');
        
    }
    public function pdfEgreso($year,$mes)
    {
        PDF::AddPage('U','A4');

        PDF::SetXY(20,15);
        PDF::SetFont('helvetica','b',22);
        PDF::Cell(170,15,"HABER ".$this->getMes($mes)." ".$year,1,0,'C');

        $pagina = 0;
		$lineaActual = 0;
		$numMaxLineas = 45;

		$altodecelda=5;
		$incremento = 30;
		$x = 10;
		$i = 0;
		$j = 1;

        $resumen = Resuman::MovimientoMensual($mes,$year)->first();
        $egresos = Movimiento::MovimientoMensual($mes,$year,'Salida')->whereNull('idactividad')->orderby('fecha','asc')->get();
        $total_egresos = $egresos->sum('monto');
        $ingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->whereNull('idactividad')->orderby('fecha','asc')->get();
        $total_ingresos = $ingresos->sum('monto');
        $rcc = $this->porcentajes($mes,$year,$total_ingresos);
        PDF::SetTextColor(9,0,255);
        #Egresos
        while ($i < $egresos->count()) {

			PDF::SetXY($x+10,$j*$altodecelda+$incremento);
			PDF::SetFont('helvetica', '', 9);
            $fecha = Carbon::parse($egresos[$i]['fecha']);
			PDF::Cell(10, 5, $fecha->day, 1, 1, 'C');
			#
			PDF::SetXY($x+20,$j*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 9);
			PDF::Cell(100, 5, $egresos[$i]['concepto'].' ('.$egresos[$i]['observacion'].')', 1, 1, 'L');
			#
			PDF::SetFont('helvetica', 'B', 11);
			PDF::SetXY($x+120, $j*$altodecelda+$incremento);
			PDF::Cell(30, 5, $egresos[$i]['montod'], 1, 1, 'R');
            #
            $i++;

            if ($i == $egresos->count()) {
                PDF::SetTextColor(0);
                PDF::SetFont('helvetica', 'B', 11);
                PDF::SetXY($x+150, $j*$altodecelda+$incremento);
                PDF::Cell(30, 5, 'S/. '.number_format($total_egresos,2), 1, 1, 'R');
            }

			$j++;

        }//cierre del while

        $incremento += 5;
        #rcc
        
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, 'RCC ', 1, 1, 'C');
        PDF::SetTextColor(9,0,255);
        #
        $j++;
        PDF::SetXY($x+10,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(10, 5, $rcc['diocesis']['label'], 1, 1, 'C');
        #
        PDF::SetXY($x+20,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(100, 5, $rcc['diocesis']['nombre'], 1, 1, 'L');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+120, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, number_format($rcc['diocesis']['valor'],2), 1, 1, 'R');
        $j++;
        PDF::SetXY($x+10,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(10, 5, $rcc['zona']['label'], 1, 1, 'C');
        #
        PDF::SetXY($x+20,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(100, 5, $rcc['zona']['nombre'], 1, 1, 'L');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+120, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, number_format($rcc['zona']['valor'],2), 1, 1, 'R');
        $j++;
        PDF::SetXY($x+10,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(10, 5, $rcc['sacerdotes']['label'], 1, 1, 'C');
        #
        PDF::SetXY($x+20,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(100, 5, $rcc['sacerdotes']['nombre'], 1, 1, 'L');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+120, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, number_format($rcc['sacerdotes']['valor'],2), 1, 1, 'R');
        $j++;
        PDF::SetXY($x+10,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(10, 5, $rcc['nacional']['label'], 1, 1, 'C');
        #
        PDF::SetXY($x+20,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', '', 9);
        PDF::Cell(100, 5, $rcc['nacional']['nombre'], 1, 1, 'L');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+120, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, number_format($rcc['nacional']['valor'],2), 1, 1, 'R');
        $j++;
        #Totales
        PDF::SetTextColor(0);
        PDF::SetTextColor(0);
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'EGRESO DEL MES DE '.$this->getMes($mes), 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $total_mes = $total_egresos;
        PDF::Cell(30, 5, 'S/. '.number_format($total_mes,2), 1, 1, 'R');
        #
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'SALDO PARA '.$this->getMes($mes+1), 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $saldo_final = $total_ingresos + $resumen->saldo_inicial - $total_egresos;
        PDF::Cell(30, 5, 'S/. '.number_format($saldo_final,2), 1, 1, 'R');
        #
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'TOTAL ', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $saldo_final = $saldo_final + $total_egresos;
        PDF::Cell(30, 5, 'S/. '.number_format($saldo_final,2), 1, 1, 'R');
        #RESUMEN
        $j++;
        $incremento += 15;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(50, 5, 'RESUMEN ', 1, 1, 'C');
        $j++;
        PDF::SetFont('helvetica', '', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(50, 5, 'Total de ingresos', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', '', 11);
        PDF::SetXY($x+60, $j*$altodecelda+$incremento);
        $t_i = $total_ingresos+$resumen->saldo_inicial;
        PDF::Cell(30, 5, 'S/. '.number_format($t_i,2), 1, 1, 'R');
        $j++;
        PDF::SetFont('helvetica', '', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(50, 5, 'Total de egresos', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', '', 11);
        PDF::SetXY($x+60, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, 'S/. '.number_format($total_egresos,2), 1, 1, 'R');
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(50, 5, 'SALDO PARA '.$this->getMes($mes+1), 1, 1, 'C');
        #
        PDF::SetFont('helvetica', '', 11);
        PDF::SetXY($x+60, $j*$altodecelda+$incremento);
        $saldo = $t_i - $total_egresos;
        PDF::Cell(30, 5, 'S/. '.number_format($saldo,2), 1, 1, 'R');
        #
        $j++;
        $incremento += 30;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(60, 5, 'FIRMA DEL COORDINADOR', 'T', 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+90, $j*$altodecelda+$incremento);
        PDF::Cell(60, 5, 'FIRMA DEL TESORERO', 'T', 1, 'C');
    }
    public function pdfIngreso($year,$mes)
    {
        PDF::AddPage('U','A4');

        PDF::SetXY(20,15);
        PDF::SetFont('helvetica','b',22);
        PDF::Cell(170,15,"DEBE ".$this->getMes($mes)." ".$year,1,0,'C');

        $pagina = 0;
		$lineaActual = 0;
		$numMaxLineas = 45;

		$altodecelda=5;
		$incremento = 50;
		$x = 10;
		$i = 0;
		$j = 1;

        $resumen = Resuman::MovimientoMensual($mes,$year)->first();
        $ingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->whereNull('idactividad')->Excluir('No')->orderby('fecha','asc')->get();
        $total_ingresos = $ingresos->sum('monto');
        $oingresos = Movimiento::MovimientoMensual($mes,$year,'Entrada')->whereNull('idactividad')->Excluir('Si')->orderby('fecha','asc')->get();
        $total_oingresos = $oingresos->sum('monto');

        #Titulos
        PDF::SetXY(20,40);
        PDF::SetFont('helvetica', 'B', 14);
        PDF::Cell(50, 5, 'SALDO INICIAL', 1, 1, 'L');
        PDF::SetXY(70,40);
        PDF::SetFont('helvetica', 'B', 14);
        PDF::Cell(120, 5, $resumen->saldo_i_d, 1, 1, 'R');
        #
        PDF::SetXY(20,50);
        PDF::SetFont('helvetica', 'B', 10);
        PDF::Cell(50, 5, 'OFRENDAS', 1, 1, 'L');
        
        PDF::SetTextColor(9,0,255);
        #Ingresos
        while ($i < $ingresos->count()) {

			PDF::SetXY($x+10,$j*$altodecelda+$incremento);
			PDF::SetFont('helvetica', '', 9);
            $fecha = Carbon::parse($ingresos[$i]['fecha']);
			PDF::Cell(10, 5, $fecha->day, 1, 1, 'C');
			#
			PDF::SetXY($x+20,$j*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 9);
            $retVal = (strlen($ingresos[$i]['observacion'])>0) ? $ingresos[$i]['observacion'] : '' ;
			PDF::Cell(100, 5, $ingresos[$i]['concepto'], 1, 1, 'L');
			#
			PDF::SetFont('helvetica', 'B', 11);
			PDF::SetXY($x+120, $j*$altodecelda+$incremento);
			PDF::Cell(30, 5, $ingresos[$i]['montod'], 1, 1, 'R');
            #
            $i++;

            if ($i == $ingresos->count()) {
                PDF::SetTextColor(0);
                PDF::SetFont('helvetica', 'B', 11);
                PDF::SetXY($x+150, $j*$altodecelda+$incremento);
                PDF::Cell(30, 5, 'S/. '.number_format($total_ingresos,2), 1, 1, 'R');
            }

			$j++;

        }//cierre del while

        #Otros ingresos
        $i = 0;
        $incremento += 10;
        #
        PDF::SetTextColor(0);
        PDF::SetXY(20,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', 'B', 10);
        PDF::Cell(50, 5, 'OTROS INGRESOS', 1, 1, 'L');
        $incremento += 5;
        PDF::SetTextColor(9,0,255);

        while ($i < $oingresos->count()) {

			PDF::SetXY($x+10,$j*$altodecelda+$incremento);
			PDF::SetFont('helvetica', '', 9);
            $fecha = Carbon::parse($oingresos[$i]['fecha']);
			PDF::Cell(10, 5, $fecha->day, 1, 1, 'C');
			#
			PDF::SetXY($x+20,$j*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 9);
            if ($oingresos[$i]['concepto']=='Otros') {
                PDF::Cell(100, 5, $oingresos[$i]['concepto'].' ('.$oingresos[$i]['observacion'].')', 1, 1, 'L');
            } else {
                PDF::Cell(100, 5, $oingresos[$i]['concepto'], 1, 1, 'L');
            }
            
			#
			PDF::SetFont('helvetica', 'B', 11);
			PDF::SetXY($x+120, $j*$altodecelda+$incremento);
			PDF::Cell(30, 5, $oingresos[$i]['montod'], 1, 1, 'R');
            #
            $i++;

            if ($i == $oingresos->count()) {
                PDF::SetTextColor(0);
                PDF::SetFont('helvetica', 'B', 11);
                PDF::SetXY($x+150, $j*$altodecelda+$incremento);
                PDF::Cell(30, 5, 'S/. '.number_format($total_oingresos,2), 1, 1, 'R');
            }

			$j++;

        }//cierre del while
        #Totales
        PDF::SetTextColor(0);
        $incremento +=5;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'INGRESO DEL MES DE '.$this->getMes($mes), 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $total_mes = $total_ingresos + $total_oingresos;
        PDF::Cell(30, 5, 'S/. '.number_format($total_mes,2), 1, 1, 'R');
        #
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'INGRESO TOTAL ', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $total = $total_ingresos + $total_oingresos + $resumen->saldo_inicial;
        PDF::Cell(30, 5, 'S/. '.number_format($total,2), 1, 1, 'R');
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
    public function getMes($mes)
    {
        switch ($mes) {
            case 1:
                $mes = 'ENERO';
                break;
            case 2:
                $mes = 'FEBRERO';
                break;
            case 3:
                $mes = 'MARZO';
                break;
            case 4:
                $mes = 'ABRIL';
                break;
            case 5:
                $mes = 'MAYO';
                break;
            case 6:
                $mes = 'JUNIO';
                break;
            case 7:
                $mes = 'JULIO';
                break;
            case 8:
                $mes = 'AGOSTO';
                break;
            case 9:
                $mes = 'SETIEMBRE';
                break;
            case 10:
                $mes = 'OCTUBRE';
                break;
            case 11:
                $mes = 'NOMVIEMBRE';
                break;
            case 12:
                $mes = 'DICIEMBRE';
                break;
        }
        return $mes;
    }
}
