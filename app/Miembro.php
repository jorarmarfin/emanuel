<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Miembro extends Model
{
    protected $table = 'miembro';
    protected $guarded = [];
    public $timestamps = false;
}
