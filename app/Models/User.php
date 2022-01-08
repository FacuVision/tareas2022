<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Perfil;
use App\Models\Docente;
use App\Models\Alumno;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //un usuario tiene un solo perfil
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    //un usuario puede ser solo un docente o un alumno
    public function docente()
    {
        return $this->hasOne(Docente::class);
    }

    public function alumno()
    {
        return $this->hasOne(Alumno::class);
    }

    public function adminlte_image()
    {
        return auth()->user()->profile_photo_url;
    }

    public function adminlte_desc()
    {

        // foreach (auth()->user()->roles as $rol) {

        //     //$array = array_push($array, $rol->name);
        //     return $rol->name;
        // }

        $roles = auth()->user()->roles;

        if (sizeof($roles)==2) {
            echo "Rol de ". $roles[0]->name . " y ". $roles[1]->name;
        } else {
            echo "Rol de ". $roles[0]->name;
        }


    }

}
