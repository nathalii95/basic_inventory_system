<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class CategoriaFormReques extends Request
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
            'nombre'=>'required|max:50',
            'descripcion'=>'max:500',
            'estado'=>'max:1',
        ];
    }
}
