<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCitaRequest extends FormRequest
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

    public function rules()
    {
        return [
            'motivo' => ['required'],
            'modalidad_id' => ['required', 'not_in:0'],
            'link' => ['required_if:modalidad_id,1'],
            'direccion' => ['required_if:modalidad_id,2'],
        ];
    }


    public function messages()                                      
    {
        return [
            'motivo.required' => __('El motivo es requerido'),
            'modalidad_id.required' => __('Selecciona una modalidad.'),
            'link.required_if' => __('Ingresa un link.'),
            'direccion.required_if' => __('Ingresa una dirección de encuentro.'),
        ];
    }
}
