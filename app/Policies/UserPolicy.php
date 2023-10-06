<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        $permitido = [1];
        return in_array(Auth::user()->rol_id, $permitido);
    }

    public function create()
    {
        $permitido = [1];
        return in_array(Auth::user()->rol_id, $permitido);
    }

    public function edit()
    {
        $permitido = [1];
        return in_array(Auth::user()->rol_id, $permitido);
    }
}
