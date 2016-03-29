<?php

namespace farmacia\Http\Requests;

use farmacia\Http\Requests\Request;

class ProductoCreateRequest extends Request
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
            'nombre'    => 'required|unique:categoria',
            'categoria' => 'required',
            'marca'     => 'required',
            'clase'     => 'required',
            'proveedor' => 'required',
            'destacado' => 'required'
        ];
    }
}
