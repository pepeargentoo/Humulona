<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadiaProducto extends Model
{
    protected $fillable = [
      'estadia',
      'cantida',
      'nombre',
      'monto'
    ];
}
