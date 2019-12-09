<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable =[
        'nombres',
        'apellidos',
        'tipo_documento_id',
        'numero_documento',
        'telefono',
        'email',
        'direccion',
        ];

    public function tipoDocumento()
    {
        return $this->belongsTo('App\models\tipos_documento', 'tipo_documento_id');
    }
}
