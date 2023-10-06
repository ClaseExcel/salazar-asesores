<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequerimientoRequest extends FormRequest
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
            'tipo_requerimiento_id' => ['required', 'not_in:0'],
            'descripcion' => ['required', 'string', 'max:255'],
            'documentos' => ['max:25000']
        ];
    }


    public function messages()
    {
        return [
            'tipo_requerimiento_id.not_in' => __('Selecciona tu tipo de requerimiento.'),
            'descripcion.required' => __('La descripción es requerida.'),
            'documentos.max' => __('El documento o los documentos no deben ser mayores a 25MB.'),
        ];
    }
}
