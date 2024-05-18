<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class HistorialProducto extends Model
{
    protected $table='historial_producto';

    protected $primaryKey='id_historialpro';

    public $timestamps=true;

    protected $fillable =[
     	
        'id_empresa',	
        'id_usuario',	
        'persona',
        'id_compra_cab', 	
        'id_dt_compra', 	
        'tipo_comprobante', 	
        'serie_comprobante', 	
        'numero_comprobante', 	
        'tipo_mov', 	
        'detalle', 	
        'id_producto',
        'stock', 	
        'cantidad', 	
        'precio', 	
        'costo_total', 	
        'fecha', 	
    ];

    protected $guarded =[

    ];
}
