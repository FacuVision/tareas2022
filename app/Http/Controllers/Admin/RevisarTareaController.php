<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;

class RevisarTareaController extends Controller
{
    public function edit($id)
    {
        $arrayString= explode("-",$id);

        $tarea_id = $arrayString[0];
        $user_id = $arrayString[1];

        $actividades = Tarea::findOrFail($tarea_id)->actividades;

        $respuestas_alumno = [];
        $id_respuestas = [];

        foreach ($actividades as $actividad) {
            $descripcion = $actividad->respuestas->where("user_id",$user_id)->pluck("descripcion");
            $respuestas_alumno[$actividad->id] = $descripcion;

            $id = $actividad->respuestas->where("user_id",$user_id)->pluck("id");
            array_push($id_respuestas, $id[0]);
        }


        return view("admin.revisiones.revision",compact("id_respuestas","actividades","user_id","tarea_id","respuestas_alumno"));
    }
}
