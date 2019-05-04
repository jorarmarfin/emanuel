<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Movimiento extends Model
{
    protected $table = 'movimiento';
    protected $guarded = [];
    public $timestamps = false;
}
