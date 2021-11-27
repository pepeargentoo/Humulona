<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LimiteFactura extends Model
{
    //
    protected $fillable = [
    	'limite',
        'actual'
    ];
}
