<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmpleadoClienteRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'cargo_id' => ['required', 'not_in:0'],
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
            'email.unique' => __('Este correo eléctronico ya existe'),
            'rol_id.required' => __('Debes seleccionar un rol.'),
            'cargo_id.not_in' => __('Debes seleccionar un cargo.'),
            'rol_id.not_in' => __('Debes seleccionar un rol.'),
            'empresa_id.not_in' => __('Debes seleccionar una empresa.'),
            'empresa_id.required' => __('Debes seleccionar una empresa.'),
            'password.required' => __('Ingresa una constraseña.')
        ];
    }
}
