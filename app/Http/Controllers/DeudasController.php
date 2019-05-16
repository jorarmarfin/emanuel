<?php

namespace App\Http\Controllers;

use App\Deuda;
use App\Miembro;
use App\Resuman;
use App\Concepto;
use App\Actividad;
use App\Movimiento;
use Illuminate\Http\Request;

class DeudasController extends Controller
{
    public function index()
    {
        $conceptos = Concepto::where('actividad',0)->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $actividades = Actividad::where('activo','si')->orderBy('nombre','asc')->pluck('nombre','id')->toarray();
        $hermanos = Miembro::orderBy('nombres','asc')->pluck('nombres','id')->toarray();
        $estados = $this->getEstados();
        return view('deudas',compact('conceptos','estados','actividades','hermanos'));
    }
    public function create(Request $request)
    {
        Deuda::create($request->all());
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
                if ($deuda->contabilizar>0) {
                    Movimiento::create([
                        'monto'=>$deuda->monto,
                        'fecha'=>$fecha,
                        'tipo'=>$tipo,
                        'idactividad'=>$deuda->idactividad,
                        'idconcepto'=>$deuda->idconcepto,
                        'observacion'=>$deuda->descripcion,
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
}
