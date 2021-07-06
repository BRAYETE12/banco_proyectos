<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class proyecto_ejecucions_has_presupuesto extends Model
{
    protected $primaryKey = ['proyecto_ejecucions_id','presupuestos_id'];
    public $incrementing = false;
    public $timestamps = false;
}
