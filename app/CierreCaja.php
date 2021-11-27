<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CierreCaja extends Model
{
    protected $fillable = [
      'fecha',
      'monto',
      //'montoiva'
    ];
}
