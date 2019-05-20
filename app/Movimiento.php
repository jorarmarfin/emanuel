<?php

namespace App;

use App\Concepto;
use Illuminate\Database\Eloquent\Model;


class Movimiento extends Model
{
    protected $table = 'movimiento';
    protected $guarded = [];
    public $timestamps = false;

    public function getConceptoAttribute() {
        $concepto = Concepto::find($this->idconcepto);
        return $concepto->nombre;
        
    }
    public function scopeMovimientoMensual($query,$mes,$year,$tipo)
    {
        return $query->whereMonth('fecha',$mes)->whereYear('fecha',$year)->where('tipo',$tipo);
    }
    public function scopeMovimientoTerceraSemana($query,$mes,$year,$tipo,$idconcepto)
    {
        return $query->whereMonth('fecha',$mes)->whereYear('fecha',$year)
                     ->where('tipo',$tipo)
                     ->where('idconcepto',$idconcepto)
                     ->where('excluir',0);
    }
    public function scopeExcluir($query,$cond)
    {
        $retVal = ($cond=='Si') ? 1 : 0 ;
        return $query->where('excluir',$retVal);
    }
}
