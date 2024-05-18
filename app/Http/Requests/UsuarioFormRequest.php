<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'id_cargo' => 'required',
            'id_empresa' => 'required',
            'id_sucursal' => 'required',
            'cedula' => 'required|max:10',
            
            'status' => 'max:1',
        ];
    }
}
