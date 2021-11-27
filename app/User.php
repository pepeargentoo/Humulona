<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'telefono',
        'direccion',
        'dni'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
