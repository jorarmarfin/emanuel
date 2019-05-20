<?php

namespace App\Http\Controllers;

use App\Deuda;
use App\Resuman;
use App\Actividad;
use Carbon\Carbon;
use App\Movimiento;
use Illuminate\Http\Request;

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

        $xcobrar = Deuda::where('idactividad',$idactividad)->where('estado','por cobrar')->get();
        $total_xcobrar = $xcobrar->sum('monto'); 

        $ganancia = $total_ingresos - $total_egresos; 
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




}
