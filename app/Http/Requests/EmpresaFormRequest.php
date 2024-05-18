<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class EmpresaFormRequest extends Request
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
            'nombre_empresa'=>'required',
            'ruc'=>'required|max:13',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
        ];
    }
}
