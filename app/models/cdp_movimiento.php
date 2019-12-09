<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cdp_movimiento extends Model
{

    protected $casts = [
        'valor' => 'double',
        'fecha' => 'datetime:Y-m-d',
    ];


}
