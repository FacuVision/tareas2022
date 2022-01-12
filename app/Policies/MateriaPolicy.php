<?php

namespace App\Policies;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MateriaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function __construct()
    {
        //
    }

    public function metodo_autorizador_materias_alumno(User $user, Materia $materia)
    {
        if($user->alumno->seccion->carpetas){
            foreach($user->alumno->seccion->carpetas as $carpeta){
                if($carpeta->materia_id == $materia->id){
                    //echo "si son iguales";
                    return true;
                }else{
                    //echo "no son iguales";
                    return false;
                }

            }
        }

    }

}
