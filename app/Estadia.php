<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadia extends Model
{
    protected $fillable = [
      'mesa',
      'fecha',
      'monto',
      'estado',
      'cocina',
      'ticketcomida',
      'ticketbebida',
      'comida',
      'bebida',
      'facturado',
      'mozo'
    ];
}
