<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\Carpeta;
use App\Models\Tarea;
use Illuminate\Database\Seeder;

class CarpetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carpeta::factory(10)->create();
        $carpetas = Carpeta::all();

        foreach ($carpetas as $c) {
            Tarea::factory(2)->create(
                [
                    'carpeta_id' => $c->id
                ]
            );
        }

       $tarea =  Tarea::all();

        foreach ($tarea as $t) {
            Actividad::factory(5)->create(
                [
                    'tarea_id' => $t->id
                ]
            );
        }

    }
}
