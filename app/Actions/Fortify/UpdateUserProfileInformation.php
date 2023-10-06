<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'cedula' => ['required', 'string', 'max:255'],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ], [
            'cedula.required' => ['Debes ingresar una cedula.'],
            'nombres.required' => ['Debes ingresar un nombre.'],
            'apellido.required' => ['Debes ingresar un apellido.'],
            'email.required' => ['Debes ingresar un email.'],
            'email.unique' => ['El correo ya existe.'],
        ])->validateWithBag('updateProfileInformation');


        $user->forceFill([
            'cedula' => $input['cedula'],
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'email' => $input['email'],
        ])->save();
    }
}
