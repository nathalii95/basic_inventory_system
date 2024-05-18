<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='detalle_compra';

    protected $primaryKey='id_dt_compra';

    public $timestamps=true;

    protected $fillable =[
        'id_compra_cab',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'descuento_porcentaje',
        'descuento',
        'iva_porcentaje',
        'iva',
        'precio_compra',
        'precio_venta',
        'cant_dev',

    ];

    protected $guarded =[

    ];
}
