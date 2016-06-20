<?php

namespace farmacia\Http\Requests;

use farmacia\Http\Requests\Request;

class ventaUpdateRequest extends Request
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
            'id_cliente'    => 'required',
            'fecha'         => 'required',
            'tipo_doc'      => 'required',
            'serie'         => 'required',
            'correlativo'   => 'required',
            'id_cliente'    => 'required',
            'fecha'         => 'required',
            'id_cliente'    => 'required',
            'id_cliente'    => 'required',
            'forma_pago'    => 'required'
        ];
    }
}
