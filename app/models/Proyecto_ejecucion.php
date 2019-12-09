<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Proyecto_ejecucion extends Model
{

    protected $fillable =[
        'proyecto_id',
        'nombre',
        'valor',
        'descripcion',
        'estado',
        'soporte'
        ];

    protected $casts = [
        'valor' => 'double'
    ];


    public function fuentes()
    {
        return $this->belongsToMany('App\models\Presupuesto', 'proyecto_ejecucions_has_presupuestos', 'presupuestos_id', 'proyecto_ejecucions_id')->withPivot('valor');
    }

}
