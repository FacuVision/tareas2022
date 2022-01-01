<?php

namespace App\Policies;

use App\Models\Carpeta;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TareaPolicy
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

    public function metodo_autorizador_tareas(User $user, Tarea $tarea)
    {
        if ($user->docente->carpetas) {
            foreach ($user->docente->carpetas as $folder) {
                if ($folder->id == $tarea->carpeta_id) {
                    //echo "si son iguales";
                    return true;
                }
                else{
                    //echo "no son iguales";
                    return false;
                }
            }
        }
    }

}
