<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class SucursalFormRequest extends Request
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
            'id_empresa' => 'required',
            'nombre' => 'required',
            'telefono' => 'required|max:10',
            'ciudad'=> 'required',
            /* 'direccion'=> 'required', */
            'email' => 'required',
            'encargado'=> 'required',      
        ];
    }
}
