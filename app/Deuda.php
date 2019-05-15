<?php

namespace App;

use App\Miembro;
use App\Concepto;
use App\Actividad;
use Illuminate\Database\Eloquent\Model;


class Deuda extends Model
{
    protected $table = 'deudas';
    protected $guarded = [];
    public $timestamps = false;

    protected $appends = ['miembro','concepto','actividad'];

    public function getMiembroAttribute() 
    { 
      $miembro = Miembro::find($this->idmiembro);
      return $miembro->nombres; 
    }
    public function getConceptoAttribute() 
    { 
      $concepto = Concepto::find($this->idconcepto);
      return $concepto->nombre; 
    }
    public function getActividadAttribute() 
    { 
      $actividad = Actividad::find($this->idactividad);
      $retVal = (isset($actividad)) ? $actividad->nombre : '---';
      return $retVal; 
    }
}
