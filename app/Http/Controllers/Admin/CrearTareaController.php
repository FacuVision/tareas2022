<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use Illuminate\Http\Request;

class CrearTareaController extends Controller
{
    public function show(Carpeta $carpeta)
    {
        $estados = ["0" => "borrador", "1"=>"publicado"];
        return view("admin.tareas.create", compact("estados", "carpeta"));

    }
}
