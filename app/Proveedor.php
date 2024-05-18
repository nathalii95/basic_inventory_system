<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table='com_proveedor';

    protected $primaryKey='id_proveedor';

    public $timestamps=true;

    protected $fillable =[
        'tipo_persona',
        'tipo_documento',
        'num_documento',
        'nombre',
        'pais',
        'provincia',
        'ciudad',
        'direccion',
        'telefono',
        'email',
        'estado',
    ];

    protected $guarded =[

    ];
}
