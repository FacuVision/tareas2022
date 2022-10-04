<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use Illuminate\Http\Request;

class CrearTareaController extends Controller
{
    public function show(Carpeta $carpeta)
    {
        $tipos = ["0" => "Tarea Normal", "1"=>"Reto"];
        return view("admin.tareas.create", compact("tipos", "carpeta"));

    }
}
