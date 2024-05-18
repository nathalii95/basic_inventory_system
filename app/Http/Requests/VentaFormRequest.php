<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class VentaFormRequest extends Request
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
            'id_cliente' =>'required',
            'tipo_comprobante' =>'required|max:20',
            'serie_comprobante' =>'required',
            'num_comprobante' =>'required|max:9',
            'forma_pago' =>'required',
            'subtotal' =>'required',
            'descuento' =>'required',
            'impuesto' =>'required',
            'total_venta' =>'required', 
            'id_producto_cab' =>'required',
            'cantidad' =>'required',
            'precio_venta' =>'required',
            'descuento' =>'required',
            'total' =>'required',
        ];
    }
}
