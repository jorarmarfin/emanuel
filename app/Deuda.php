<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Deuda extends Model
{
    protected $table = 'deudas';
    protected $guarded = [];
    public $timestamps = false;
}
