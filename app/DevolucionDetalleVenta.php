<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class DevolucionDetalleVenta extends Model
{
    protected $table='ven_devolucion_det';

    protected $primaryKey='id_dev_det';

    public $timestamps=true;

    protected $fillable =[
        'id_dev_cab',
        'id_dt_venta',
        'id_producto',
        'cantidad_vendida',
        'precio_venta',
        'cant_devuelta',
        'descuento_porcentaje',
        'descuento',
        'iva_porcentaje',
        'iva',
        'total',
    ];

    protected $guarded =[

    ];
}
