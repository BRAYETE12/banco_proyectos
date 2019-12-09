<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Fuentes_financiacion extends Model
{
    protected $fillable =[
        'anio',
        'nombre',
        'valor',
        'soporte',
        'estado',
        'tipos_fuentes_id'
        ];

    protected $casts = [
        'valor' => 'double',
        'anio' => 'int',
    ];

    public function tipo()
    {
        return $this->belongsTo('App\models\Tipos_fuente', 'tipos_fuentes_id');
    }

}
