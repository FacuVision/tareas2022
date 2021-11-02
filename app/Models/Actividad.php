<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Respuesta;
use App\Models\Tarea;

class Actividad extends Model
{
    use HasFactory;

    //UNA ACTIVIDAD SOLO TIENE UNA RESPUESTA
    public function respuesta()
    {
        return $this->hasOne(Respuesta::class);
    }

        //UNA ACTIVIDAD PERTENECE A UNA SOLA TAREA
        public function tarea()
        {
            return $this->belongsTo(Tarea::class);
        }
}
