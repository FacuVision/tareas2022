<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarea;

class Carpeta extends Model
{
    use HasFactory;

    //UNA CARPETA POSEE MUCHAS TAREAS EN SU INTERIOR
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
