<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class DevolucionDetalleCompra extends Model
{
    protected $table='com_devolucion_det';

    protected $primaryKey='id_dev_det';

    public $timestamps=true;

    protected $fillable =[
        'id_dev_cab',
        'id_dt_compra',
        'id_producto',
        'cantidad_vendida',
        'precio_unitario',
        'cant_devuelta',
        'descuento_porcentaje',
        'descuento',
        'iva_porcentaje',
        'iva',
        'precio_compra',
        'precio_venta',
        'total',
    ];

    protected $guarded =[

    ];
}
