<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cdp extends Model
{

    protected $casts = [
        'valor' => 'double',
        'fecha' => 'datetime:Y-m-d',
    ];

    public function fuente()
    {
        return $this->belongsTo('App\models\Fuentes_financiacion', 'fuentes_id')->with("tipo");
    }

    public function movimientos()
    {
        return $this->hasMany('App\models\cdp_movimiento', 'cdps_id');
    }

    public function proyectos_financiados()
    {
        return $this->belongsToMany('App\models\Proyecto', 'proyectos_financiados_cdps', 'cdps_id', 'proyectos_id')->withPivot('fecha', 'valor');;
    }

}
