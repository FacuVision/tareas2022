<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;
use App\Models\Image;

class Logro extends Model
{
    use HasFactory;

    //Muchos logros son asignados a muchos alumnos

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_logro', 'id', 'user_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
