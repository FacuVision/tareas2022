<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $primaryKey = 'user_id';

    use HasFactory;

    //un docente pertenece a un usuario

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
