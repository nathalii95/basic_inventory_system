<?php

namespace sisInv;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table='producto';

    protected $primaryKey='id_producto';

    public $timestamps=true;

    protected $fillable =[
        'id_categoria',
        'codigo',
        'codigo_externo',
        'nombre',
        'marca',
        'color',
        'modelo',
        'descripcion',
        'stock',
        'descuento',
        'is_impuesto',
        'impuestoValor',
        'imagen',
        'estado',
    ];

    protected $guarded =[

    ];

    function detalle_compra() {
        return $this->belongsTo('App\DetalleIngreso', 'id_producto', 'id_producto');
    }

    function compra() {
        return $this->belongsTo('App\Empresa', 'id_compra', 'id_compra_cab');
    }

}
