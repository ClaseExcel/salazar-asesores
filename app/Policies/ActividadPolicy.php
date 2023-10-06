<?php

namespace App\Policies;

use App\Models\Actividad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ActividadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        $permitidos = [1,2,3,4,5,6,7,8];
        return in_array(Auth::user()->rol_id, $permitidos);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view()
    {
        $permitidos = [1,2,3,4,5,6,7,8];
        return in_array(Auth::user()->rol_id, $permitidos);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        $permitidos = [1,2,8];
        return in_array(Auth::user()->rol_id, $permitidos);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update()
    {
        $permitidos = [1,2,3,4,5,6,7,8];
        return in_array(Auth::user()->rol_id, $permitidos);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Actividad $actividad)
    {
        $permitidos = [1];
        return in_array(Auth::user()->rol_id, $permitidos);
    }
}
