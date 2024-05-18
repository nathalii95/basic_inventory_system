<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='ven_cliente';

    protected $primaryKey='id_cliente';

    public $timestamps=true;

    protected $fillable =[
        'tipo_documento',
        'num_documento',
        'nombre',
        'pais',
        'provincia',
        'ciudad',
        'direccion',
        'telefono',
        'email',
        'is_retencion',
        'retencionValor',
        'estado',
    ];

    protected $guarded =[

    ];
}
