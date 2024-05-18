<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class ClienteFormRequest extends Request
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
            'nombre' => 'required|max:100',
            'tipo_documento' => 'required|in:Ruc,Cédula,Pasaporte',
            'num_documento' => 'required|numeric',
            'pais' => 'max:100',
            'provincia'=> 'max:100',
            'ciudad' => 'max:100',
            'direccion'=> 'max:100',
            'telefono' => 'required|numeric',
            'email'=> 'required|max:50',
            'estado' => 'max:1',
        ];
    }
}
