<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $fillable = [
      'nombre',
      'tipo',
      'unidadminima',
      'unidadactuales',
      'preciocompra',
      'precioventa',
      'descripcion',
      'categoria',
      'proveedor'
    ];

}
