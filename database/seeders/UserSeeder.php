<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Perfil;
use App\Models\User;
use App\Models\Docente;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //COSAS DE EMMNANUEL

            $admin = User::create([
                "name" => "Emmanuel",
                "email" => "emma@gmail.com",
                "password" => bcrypt("12345")
            ]);

            $date = new DateTime("2001-01-18");

            $admin->perfil()->create(
                [
                    "nombre" => "Emmanuel",
                    "apellido" => "Garayar",
                    "DNI" => "74741985",
                    "fecha_nac" => $date,
                    "edad" => "20",
                    "sexo" => "m",
                    "direccion" => "En mi casa",
                    "distrito" => "V.E.S"
                ]
            );




    // CREACION DE LOS DEMAS USUARIOS

    //CREACION DE DOCENTES ****************************************************************************

       $docentes = User::factory(5)->create();
        //Selecciona a todos los usuarios asignando a la variable todos

        foreach ($docentes as $d) {

            Perfil::factory()->create([

                //Iguala el name de los usuarios a nombre de los perfiles
                "nombre" => $d->name,
                //Iguala el id de los usuarios a user_id de los perfiles
                "user_id" => $d->id
            ]);

            Docente::factory()->create([
                "user_id" => $d->id
            ]);

                //ASIGNAMOS MATERIAS RANDOM AL DOCENTE
                $docID = Docente::find($d->id);
                $docID->materias()->attach([rand(1,10),rand(1,10)]);

                //ASIGNAMOS SECCIONES A LOS DOCENTES
                $docID->secciones()->attach([rand(1,12),rand(1,12),rand(1,12),rand(1,12)]);
        }


        //CREACION DE ALUMNOS ****************************************************************************

        $alumnos = User::factory(14)->create();
        //Selecciona a todos los usuarios asignando a la variable todos

        foreach ($alumnos as $al) {

            Perfil::factory()->create([

                //Iguala el name de los usuarios a nombre de los perfiles
                "nombre" => $al->name,
                //Iguala el id de los usuarios a user_id de los perfiles
                "user_id" => $al->id
            ]);

            Alumno::factory()->create([
                "user_id" => $al->id,
                "seccion_id" => random_int(1,12)
            ]);

        }


    }
}
