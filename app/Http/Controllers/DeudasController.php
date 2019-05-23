<?php

namespace App\Http\Controllers;

use App\Deuda;
use App\Miembro;
use App\Resuman;
use App\Concepto;
use App\Actividad;
use Carbon\Carbon;
use App\Movimiento;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class DeudasController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::where('actividad',0)->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $actividades = $this->getActividades();
        $hermanos = Miembro::orderBy('nombres','asc')->pluck('nombres','id')->toarray();
        $estados = $this->getEstados();
        return view('deudas',compact('conceptos','estados','actividades','hermanos'));
    }
    public function indexa()
    {
        $conceptos = Concepto::where('actividad',1)->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $actividades = $this->getActividades();
        $hermanos = Miembro::orderBy('nombres','asc')->pluck('nombres','id')->toarray();
        $estados = $this->getEstados();
        return view('deudas',compact('conceptos','estados','actividades','hermanos'));
    }
    public function getActividades()
    {
        $actividad = Actividad::orderBy('nombre','asc')->select('nombre','fecha','id')->get();
        $actividades = [];
        foreach ($actividad as $key => $value) {
            $nombre = $value->nombre.' - '.$value->fecha;
            $actividades = Arr::add($actividades, $value->id, $nombre);
        }
        return $actividades;
    }
    public function create(Request $request)
    {
        Deuda::create($request->all());
        return redirect()->route('deudas.dashboard');
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
    public function gettabla($name)
    {
        $tabla['data'] = Deuda::where('estado',$name)->get();
        return response()->json($tabla,'200');
    }
    public function contabilizar(Request $request)
    {
        $iddeuda = $request->get('iddeuda');
        $fecha = $request->get('fecha');
        $arreglo = explode("-",$fecha);
        $resumen = Resuman::where('year',$arreglo[0])->where('month',$arreglo[1])->where('cerrado',0)->get();
        if ($resumen->count()>0) {
            $movimiento =  Movimiento::where('iddeuda',$iddeuda)->get();
            if ($movimiento->count()<1) {
                $deuda = Deuda::find($iddeuda);
                switch ($deuda->estado) {
                    case 'por pagar':
                        $tipo = 'Salida';
                        $estado = 'pagado';
                        break;
                    case 'por cobrar':
                        $tipo = 'Entrada';
                        $estado = 'cobrado';
                        break;                    
                }
                if ($deuda->contabilizar=='si') {
                    $txt = 'numero deuda: '.$iddeuda;
                    Movimiento::create([
                        'monto'=>$deuda->monto,
                        'fecha'=>$fecha,
                        'tipo'=>$tipo,
                        'idconcepto'=>$deuda->idconcepto,
                        'observacion'=>$txt.' '.$deuda->descripcion,
                        'iddeuda'=>$deuda->id,
                    ]);
                }
                $deuda->estado = $estado;
                $deuda->fecha = date('Y-m-d');
                $deuda->save();
            }
        }
        return redirect()->route('deudas.dashboard');
    }
    public function extornar($iddeuda)
    {
        $deuda = Deuda::find($iddeuda);
        $fecha = Carbon::createFromFormat('Y-m-d',$deuda->fecha_deuda);
        $resumen = Resuman::MovimientoMensual($fecha->month,$fecha->year)->first();
        if ($resumen->cerrado) {
            $movimiento =  Movimiento::where('iddeuda',$iddeuda)->delete();
            switch ($deuda->estado) {
                case 'pagado':
                    $tipo = 'Salida';
                    $estado = 'por pagar';
                    break;
                case 'cobrado':
                    $tipo = 'Entrada';
                    $estado = 'por cobrar';
                    break;                    
            }
            $deuda->estado = $estado;
            $deuda->fecha = date('Y-m-d');
            $deuda->save();
        }
        return redirect()->route('deudas.dashboard');
    }
}
