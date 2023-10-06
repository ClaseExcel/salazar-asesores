<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoClienteRequest extends FormRequest
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
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'numero_contacto' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'rol_id' => ['required', 'not_in:0'],
            'empresa_id' => ['required', 'not_in:0'],
        ];
    }


    public function messages()
    {
        return [
            'numero_contacto.required' => __('Debes ingresar un número de contacto.'),
            'nombres.required' => __('Debes ingresar un nombre.'),
            'apellidos.required' => __('Debes ingresar un apellido.'),
            'email.required' => __('El correo eléctronico es requerido.'),
            'rol_id.not_in' => __('Debes seleccionar un rol.'),
            'rol_id.required' => __('Debes seleccionar un rol.'),
            'empresa_id.not_in' => __('Debes seleccionar un rol.'),
        ];
    }
}
