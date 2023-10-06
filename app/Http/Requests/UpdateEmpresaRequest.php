<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresaRequest extends FormRequest
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
            'NIT' => ['required', 'string', 'max:255'],
            'razon_social' => ['required', 'string', 'max:255'],
            'numero_contacto' => ['required'],
            'correo_electronico' => ['required'],
            'direccion_fisica' => ['required'],
            'frecuencia_id' => ['required', 'not_in:0'],
        ];
    }


    public function messages()
    {
        return [
            'NIT.required' => __('Debes ingresar un NIT.'),
            'razon_social.required' => __('Debes ingresar una razón social.'),
            'direccion_fisica.required' => __('Debes ingresar una dirección.'),
            'frecuencia_id.not_in' => __('Debes seleccionar su frecuencia.'),
            'numero_contacto.required' => __('El numero de contacto es requerido.'),
            'correo_electronico.required' => __('El correo électronico es requerido.'),
        ];
    }
}
