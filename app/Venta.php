<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';

    protected $primaryKey='id_venta';

    public $timestamps=true;

    protected $fillable =[
        'id_cliente',
        'id_usuario',
        'id_empresa',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'forma_pago',
        'fecha',
        'fecha_emision',
        'fecha_caducidad',
        'subtotal',
        'descuento',
        'descuento_porcentaje',
        'impuesto_porcentaje',
        'impuesto',
        'total_venta',
        'retencion',
        'retencion_porcentaje',
        'estado',

    ];

    protected $guarded =[

    ];
}
