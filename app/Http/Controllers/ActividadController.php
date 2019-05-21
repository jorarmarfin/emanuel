<?php

namespace App\Http\Controllers;

use App\Deuda;
use App\Resuman;
use App\Actividad;
use Carbon\Carbon;
use App\Movimiento;
use Illuminate\Http\Request;
use PDF;
class ActividadController extends Controller
{
    public function lista()
    {
        $actividades = Actividad::orderby('fecha','desc')->get();
        return view('actividad-lista',compact('actividades'));
    }
    public function balance($idactividad)
    {
        $actividad = Actividad::find($idactividad);
        $ingresos = Movimiento::where('idactividad',$idactividad)->where('tipo','Entrada')->orderBy('fecha','asc')->get();
        $total_ingresos = $ingresos->sum('monto');

        $egresos = Movimiento::where('idactividad',$idactividad)->where('tipo','Salida')->orderBy('fecha','asc')->get();
        $total_egresos = $egresos->sum('monto');

        $xcobrar = Deuda::where('idactividad',$idactividad)->whereIn('estado',['por cobrar','cobrado'])->get();
        $total_xcobrar = $xcobrar->sum('monto'); 

        $ganancia = $total_ingresos + $total_xcobrar - $total_egresos; 
        $ganancia_liquida = $ganancia - $total_xcobrar;

        return view('actividad-balance',
        compact('actividad','egresos','total_egresos','ingresos','total_ingresos','xcobrar','total_xcobrar','ganancia','ganancia_liquida')
        );
    }
    public function cierre(Request $request)
    {
        $actividad = Actividad::find($request->get('idactividad'));
        $fecha = Carbon::createFromFormat('Y-m-d',$actividad->fecha);
        $resumen = Resuman::MovimientoMensual($fecha->month,$fecha->year)->first();
        if (!$resumen->cerrado) {
            Movimiento::create([
                'monto'=>$request->get('ganancia'),
                'fecha'=>$fecha,
                'tipo'=>'Entrada',
                'idconcepto'=>$actividad->idconcepto,
                'observacion'=>$actividad->nombre.'-'.$actividad->fecha,
            ]);
            $actividad->cerrado='si';
            $actividad->save();
            $mensaje = 'Caja Cerrada';
        }else{
            $mensaje = 'La caja ya esta cerrada para esta fecha';
        }
        $request->session()->flash('flash_message',$mensaje);
        return back();
    }
    public function reporte($idactividad)
    {
        return view('actividad-reporte',compact('idactividad'));
    }
    public function pdf($idactividad)
    {
        PDF::SetTitle('BALANCE MENSUAL ACTIVIDAD');
        $this->pdfIngreso($idactividad);
        $this->pdfEgreso($idactividad);
        PDF::SetAutoPageBreak(false);
        
        $archivo = public_path('storage/').'actividad_'.$idactividad.'.pdf';
        
        #EXPORTO
        PDF::Output($archivo,'FI');
    }
    public function pdfEgreso($idactividad)
    {
        $actividad = Actividad::find($idactividad);
        PDF::AddPage('U','A4');
        PDF::SetXY(20,15);
        PDF::SetFont('helvetica','b',22);
        PDF::Cell(170,15,"HABER ".$actividad->nombre." ".$actividad->fecha,1,0,'C');

        $pagina = 0;
		$lineaActual = 0;
		$numMaxLineas = 45;

		$altodecelda=5;
		$incremento = 35;
		$x = 10;
		$i = 0;
		$j = 1;

        $egresos = Movimiento::where('idactividad',$idactividad)->where('tipo','Salida')->orderBy('fecha','asc')->get();
        $total_egresos = $egresos->sum('monto');


        PDF::SetTextColor(9,0,255);
        #Ingresos
        while ($i < $egresos->count()) {

			PDF::SetXY($x+10,$j*$altodecelda+$incremento);
			PDF::SetFont('helvetica', '', 9);
            $fecha = Carbon::parse($egresos [$i]['fecha']);
			PDF::Cell(10, 5, $fecha->day, 1, 1, 'C');
			#
			PDF::SetXY($x+20,$j*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 9);
			PDF::Cell(100, 5, $egresos[$i]['concepto'], 1, 1, 'L');
			#
			PDF::SetFont('helvetica', '', 11);
			PDF::SetXY($x+120, $j*$altodecelda+$incremento);
			PDF::Cell(30, 5, $egresos[$i]['montod'], 1, 1, 'R');
            #
            $i++;

            if ($i == $egresos  ->count()) {
                PDF::SetFont('helvetica', 'B', 11);
                PDF::SetXY($x+150, $j*$altodecelda+$incremento);
                PDF::Cell(30, 5, 'S/. '.number_format($total_egresos,2), 1, 1, 'R');
            }

			$j++;

        }//cierre del while
        #RESUMEN DE ACTIVIDAD
        $ingresos = Movimiento::where('idactividad',$idactividad)->where('tipo','Entrada')->orderby('fecha','asc')->get();
        $total_ingresos = $ingresos->sum('monto');

        $xcobrar = Deuda::where('idactividad',$idactividad)->whereIn('estado',['por cobrar','cobrado'])->get();
        $total_xcobrar = $xcobrar->sum('monto'); 

        PDF::SetTextColor(0);
        $incremento +=5;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'INGRESO TOTAL', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, 'S/. '.number_format($total_ingresos + $total_xcobrar,2), 1, 1, 'R');
        #
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'EGRESOS', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        PDF::Cell(30, 5, 'S/. '.number_format($total_egresos,2), 1, 1, 'R');
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'GANANCIA', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $ganancia = $total_ingresos + $total_xcobrar - $total_egresos;
        PDF::Cell(30, 5, 'S/. '.number_format($ganancia,2), 1, 1, 'R');
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'POR COBRAR', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $ganancia = $total_ingresos + $total_xcobrar - $total_egresos;
        PDF::Cell(30, 5, 'S/. '.number_format($total_xcobrar,2), 1, 1, 'R');
        $j++;
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+10, $j*$altodecelda+$incremento);
        PDF::Cell(140, 5, 'GANANCIA LIQUIDA', 1, 1, 'C');
        #
        PDF::SetFont('helvetica', 'B', 11);
        PDF::SetXY($x+150, $j*$altodecelda+$incremento);
        $ganancia_liquida = $ganancia - $total_xcobrar;
        PDF::Cell(30, 5, 'S/. '.number_format($ganancia_liquida,2), 1, 1, 'R');

    }
    public function pdfIngreso($idactividad)
    {
        $actividad = Actividad::find($idactividad);
        PDF::AddPage('U','A4');
        PDF::SetXY(20,15);
        PDF::SetFont('helvetica','b',22);
        PDF::Cell(170,15,"DEBE ".$actividad->nombre." ".$actividad->fecha,1,0,'C');

        $pagina = 0;
		$lineaActual = 0;
		$numMaxLineas = 45;

		$altodecelda=5;
		$incremento = 35;
		$x = 10;
		$i = 0;
		$j = 1;

        $ingresos = Movimiento::where('idactividad',$idactividad)->where('tipo','Entrada')->orderby('fecha','asc')->get();
        $total_ingresos = $ingresos->sum('monto');


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
			PDF::Cell(100, 5, $ingresos[$i]['concepto'], 1, 1, 'L');
			#
			PDF::SetFont('helvetica', '', 11);
			PDF::SetXY($x+120, $j*$altodecelda+$incremento);
			PDF::Cell(30, 5, $ingresos[$i]['montod'], 1, 1, 'R');
            #
            $i++;

            if ($i == $ingresos->count()) {
                PDF::SetFont('helvetica', 'B', 11);
                PDF::SetXY($x+150, $j*$altodecelda+$incremento);
                PDF::Cell(30, 5, 'S/. '.number_format($total_ingresos,2), 1, 1, 'R');
            }

			$j++;

        }//cierre del while
        $xcobrar = Deuda::where('idactividad',$idactividad)->whereIn('estado',['por cobrar','cobrado'])->get();
        $total_xcobrar = $xcobrar->sum('monto'); 
        $i = 0;
        $incremento += 10;
        #Deudas
        PDF::SetTextColor(0);
        PDF::SetXY(20,$j*$altodecelda+$incremento);
        PDF::SetFont('helvetica', 'B', 10);
        PDF::Cell(50, 5, 'DEUDAS POR COBRAR', 1, 1, 'L');
        $incremento += 5;
        PDF::SetTextColor(9,0,255);
        while ($i < $xcobrar->count()) {

            PDF::SetXY($x+10,$j*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 9);
            $fecha = Carbon::parse($xcobrar[$i]['fecha_deuda']);
            PDF::Cell(10, 5, $fecha->day, 1, 1, 'C');
            #
            PDF::SetXY($x+20,$j*$altodecelda+$incremento);
            PDF::SetFont('helvetica', '', 9);
            PDF::Cell(100, 5, $xcobrar[$i]['miembro']."  (".$xcobrar[$i]['estado'].")", 1, 1, 'L');
            #
            PDF::SetFont('helvetica', '', 11);
            PDF::SetXY($x+120, $j*$altodecelda+$incremento);
            PDF::Cell(30, 5, $xcobrar[$i]['montod'], 1, 1, 'R');
            #
            $i++;

            if ($i == $xcobrar->count()) {
                PDF::SetFont('helvetica', 'B', 11);
                PDF::SetXY($x+150, $j*$altodecelda+$incremento);
                PDF::Cell(30, 5, 'S/. '.number_format($total_xcobrar,2), 1, 1, 'R');
            }

            $j++;

        }//cierre del while

    }



}
