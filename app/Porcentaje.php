<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Porcentaje extends Model
{
    protected $table = 'porcentaje';
    protected $guarded = [];
    public $timestamps = false;

    public function getValorPAttribute() {
        return $this->valor/100;
    }
    public function getValorLAttribute() {
        return $this->valor.'%';
    }
}
