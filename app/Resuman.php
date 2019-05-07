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
}
