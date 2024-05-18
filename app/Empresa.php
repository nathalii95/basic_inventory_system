<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table='empresa';

    protected $primaryKey='id_empresa';

    public $timestamps=true;

    protected $fillable =[
        'nombre_empresa',
        'ruc',
        'r_legal',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'estado',
    ];

    protected $guarded =[

    ];
}
