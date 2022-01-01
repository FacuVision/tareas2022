<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Carpeta;

class CarpetaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function metodo_autorizador_carpetas(User $user, Carpeta $carpeta)
    {
        //solo permitirá a usuario de la carpeta correspondiente acceder al mismo (ver, editar o borrar)
        if ($user->id == $carpeta->user_id) {
            return true;
        } else{
            return false;
        }
    }
}
