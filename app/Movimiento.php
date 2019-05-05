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
}
