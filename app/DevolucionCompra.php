<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class DevolucionCompra extends Model
{
    protected $table='com_devolucion_cab';

    protected $primaryKey='id_devolucion';

    public $timestamps=true;

    protected $fillable =[
     
        'id_empresa',
        'id_sucursal',
        'id_usuario',
        'id_cargo',
        'id_proveedor',
        'id_compra_ant',
        'comp_serie_ant',
        'comp_num_ant',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
        'fecha_dev',
        'fecha_caducidad',
        'subtotal',
        'descuento',
        'descuento_porcentaje',
        'impuesto',
        'impuesto_porcentaje',
        'total_dev',
        'total_anterior',
        'retencion',
        'retencion_porcentaje',
        'motivo_dev',
        'nota',
        'cantidad_dev',
        'estado',
        

    ];

    protected $guarded =[

    ];
}
