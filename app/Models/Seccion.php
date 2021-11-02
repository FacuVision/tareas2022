<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grado;
use App\Models\Alumno;

class Seccion extends Model
{
    use HasFactory;


    //una seccion pertenece a un solo grado
    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    //las secciones aparecen en los registros de muchos alumnos
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }


}

