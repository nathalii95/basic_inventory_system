<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class IngresoFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_proveedor' =>'required',
            'tipo_comprobante' =>'required',
            'serie_comprobante' =>'required',
            'numero_comprobante' =>'required|max:9',
            'subtotal' =>'required',
            'descuento' =>'required',
            'descuento_porcentaje' =>'required',
            'impuesto' =>'required',
            'impuesto_porcentaje' =>'required',
            'totalCompra' =>'required',
            'observacion' =>'max:500',
            'id_producto' =>'required',
            'cantidad' =>'required',
            'precio_compra' =>'required',
            'precio_venta' =>'required',
        ];
    }
}
