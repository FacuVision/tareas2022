<?php

namespace App\Policies;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TareaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function metodo_autorizador_tareas(User $user, Tarea $tarea)
    {
        if ($user->docente->carpetas) {
            foreach ($user->docente->carpetas as $folder) {
                if ($folder->id == $tarea->carpeta_id) {
                    echo "si son iguales";
                    return true;
                }
                else{
                    echo "no son iguales";
                    return false;
                }
            }
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Tarea $tarea)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tarea $tarea)
    {
        //METODO PARA LA REVISION DE LAS TAREAS

        if ($tarea->carpeta->user_id === $user->id) {
            //echo "la tarea le pertenece";
            return true;
        }
        else{
            //echo "la tarea no le pertenece";
            return false;
        }


    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tarea $tarea)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Tarea $tarea)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Tarea $tarea)
    {
        //
    }
}


