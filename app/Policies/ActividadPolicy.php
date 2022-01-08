<?php

namespace App\Policies;

use App\Models\Actividad;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActividadPolicy
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

    public function metodo_autorizador_actividades(User $user, Actividad $actividad)
    {

        if ($actividad->tarea->carpeta->docente->user->id == $user->id) {
           //echo "la actividad le pertenece al usuario";
           return true;
        } else {
           //echo "la actividad no le pertenece al usuario";
           return false;
    }    }

    public function metodo_eliminador_actividades(User $user, Tarea $tarea)
    {
        return false;
    }

    public function metodo_desautorizador_asignacion_actividades(User $user, Actividad $actividad)
    {
        return false;
    }

}
