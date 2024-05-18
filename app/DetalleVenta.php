<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table='detalle_venta';

    protected $primaryKey='id_dt_venta';

    public $timestamps=true;

    protected $fillable =[
        'id_venta_cab',
        'id_producto_cab',
        'cantidad',
        'precio_venta',
        'descuento_porcentaje',
        'descuento',
        'iva_porcentaje',
        'iva',
        'total',
        'cant_dev',

    ];

    protected $guarded =[

    ];
}
