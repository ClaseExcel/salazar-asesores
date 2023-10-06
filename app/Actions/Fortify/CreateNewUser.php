<?php

namespace App\Actions\Fortify;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'cedula' => ['required', 'string', 'max:255'],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'cargo_id' => ['required'],
            'rol_id' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'cedula.required' => __('Debes ingresar tu cedula.'),
            'nombres.required' => __('Debes ingresar un nombre.'),
            'apellidos.required' => __('Debes ingresar un apellido.'),
            'email.required' => __('El email es requerido.'),
            'password.required' => __('Debes ingresar una contraseña.'),
            'cargo_id.required' => __('Debes seleccionar un cargo.'),
            'rol_id.required' => __('Debes seleccionar un rol.'),
        ])->validateWithBag('createUser');;

        return User::create([
            'cedula' => $input['cedula'],
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'email' => $input['email'],
            'cargo_id' => $input['cargo_id'],
            'rol_id' => $input['rol_id'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
