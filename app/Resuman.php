<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Resuman extends Model
{
    protected $table = 'resumen';
    protected $guarded = [];
    public $timestamps = false;

    public function scopeMovimientoMensual($query,$mes,$year)
    {
        return $query->where('month',$mes)->where('year',$year);
    }
    public function getSaldoIDAttribute() {

        return 'S/. '.number_format($this->saldo_inicial,2);
        
    }
    public function getSaldoFDAttribute() {

        return 'S/. '.number_format($this->saldo_final,2);
        
    }
}
