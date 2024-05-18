<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='compra';

    protected $primaryKey='id_compra';

    public $timestamps=true;

    protected $fillable =[
        'id_proveedor',
        'id_usuario',
        'id_empresa',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
        'forma_pago',
        'fecha',
        'fecha_caducidad',
        'subtotal',
        'descuento',
        'descuento_porcentaje',
        'impuesto',
        'impuesto_porcentaje',
        'totalCompra',
        'retencion',
        'retencion_porcentaje',
        'observacion',
        'documento',
        'estado',

    ];

    protected $guarded =[

    ];
}
