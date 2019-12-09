<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $casts = [
        'valor' => 'float'
    ];

    protected $fillable =[
        'nombre',
        'cuerpo',
        'fecha_radicacion',
        'fecha_inicio',
        'fecha_fin',
        'valor',
        'estado'
        ];
}
