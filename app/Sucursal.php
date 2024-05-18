<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table='sucursal';

    protected $primaryKey='id_sucursal';

    public $timestamps=true;

    protected $fillable =[
        'id_empresa',
        'nombre',
        'telefono',
        'ciudad',
        'direccion',
        'email',
        'encargado',
        'estado',
    ];

    protected $guarded =[

    ];

    function company() {
        return $this->belongsTo('App\Empresa', 'id_empresa', 'id_empresa');
    }

}
