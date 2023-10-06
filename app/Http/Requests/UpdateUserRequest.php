<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'cedula' => ['required', 'string', 'max:255'],
            'nombres' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'cargo_id' => ['required', 'not_in:0'],
            'rol_id' => ['required', 'not_in:0'],
        ];
    }


    public function messages()
    {
        return [
            'cedula.required' => __('Debes ingresar tu cedula.'),
            'nombres.required' => __('Debes ingresar un nombre.'),
            'email.required' => __('El email es requerido.'),
            'email.unique' => __('Este correo eléctronico ya existe'),
            'cargo_id.required' => __('Debes seleccionar un cargo.'),
            'rol_id.required' => __('Debes seleccionar un rol.'),
            'cargo_id.not_in' => __('Debes seleccionar un cargo.'),
            'rol_id.not_in' => __('Debes seleccionar un rol.'),
        ];
    }
}
