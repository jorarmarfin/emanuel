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
}
