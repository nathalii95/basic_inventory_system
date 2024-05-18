<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class catalogo extends Model
{
    protected $table='sis_catalogo';

    protected $primaryKey='id_catalogo';

    public $timestamps=true;

    protected $fillable =[
        'id_empresa',
        'tipo',
        'grupo',
        'valor',
        'descripcion',
        'estado',

    ];

    protected $guarded =[

    ];
}

