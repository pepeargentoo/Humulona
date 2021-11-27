<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    //
    protected $fillable = [
      'tipo',
      'descripcion',
      'monto'
    ];
}
