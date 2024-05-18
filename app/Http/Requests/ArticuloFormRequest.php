<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class ArticuloFormRequest extends Request
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
        //validacion en form con el name (ejemplo('id_categoria'))
        return [
            'id_categoria' => 'required',
            'codigo' => 'required',
            'nombre' => 'required|max:100',
            'codigo' => 'max:100',
            'marca'=> 'max:50',
            'color'=> 'max:50',
            'modelo'=> 'max:50',
            'descripcion' => 'max:500',
            'stock'=> 'required', 
            'impuesto_valor'=> 'numeric',
            'imagen'=> 'mimes:jpeg,bmp,png,jpg',
            'estado'=> 'max:50',      
        ];
    }
}
