<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Storage::disk('public')->deleteDirectory('_logros');
        Storage::disk('public')->deleteDirectory('_actividades');
        Storage::disk('public')->deleteDirectory('_respuestas');

        Storage::disk('public')->makeDirectory('_logros');
        Storage::disk('public')->makeDirectory('_actividades');
        Storage::disk('public')->makeDirectory('_respuestas');


        $this->call(LogroSeeder::class);
        $this->call(GradoSeeder::class);
        $this->call(MateriaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CarpetaSeeder::class);
        $this->call(MensajeSeeder::class);


        //asignacion de tareas a los alumnos
        $alumno = Alumno::all();

            foreach ($alumno as $a) {

                $a->tareas()->attach(rand(1,20),["nota_final" => rand(1,20)]);
                $a->tareas()->attach(rand(1,20),["nota_final" => rand(1,20)]);
            }


    }
}
