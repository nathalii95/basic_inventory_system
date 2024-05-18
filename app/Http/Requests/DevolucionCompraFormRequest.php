<?php

namespace sisInv\Http\Requests;

use sisInv\Http\Requests\Request;

class DevolucionCompraFormRequest extends Request
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
        /*     'cantidad' => 'required|min:0',
            'cant_devuelta' => 'required|min:0', */
        ];
    }
}
