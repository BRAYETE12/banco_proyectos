<?php

namespace App\models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Proyectos_integrante extends Model
{
    protected $primaryKey = ['proyecto_id','persona_id','rol_id'];
    public $incrementing = false;

    public function rol()
    {
        return $this->belongsTo('App\models\Roles_proyecto', 'rol_id');
    }

    public function persona()
    {
        return $this->belongsTo('App\models\Persona', 'persona_id')->with("tipoDocumento");
    }


    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where('proyecto_id', $this->getAttribute('proyecto_id'))
                     ->where('persona_id', $this->getAttribute('persona_id'))
                     ->where('rol_id', $this->getAttribute('rol_id'));
    }

}
