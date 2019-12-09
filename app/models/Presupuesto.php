<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $fillable =[
        'proyecto_id',
        'nombre',
        'valor',
        'descripcion',
        'estado'
        ];
}
