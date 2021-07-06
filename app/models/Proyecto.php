<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $casts = [
        'valor' => 'float'
    ];

    protected $fillable =[
        'estado_id',
        'nombre',
        'cuerpo',
        'fecha_radicacion',
        'fecha_inicio',
        'fecha_finalizacion',
        'valor',
        'estado'
        ];
}
