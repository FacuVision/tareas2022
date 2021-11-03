<?php

namespace Database\Seeders;

use App\Models\Grado;
use App\Models\Seccion;
use Illuminate\Database\Seeder;

use function PHPUnit\Framework\isNull;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        //SE CREA LOS GRADOS,EN ESTE CASO NECESITAMOS 6 REGISTROS

        $grados =  ["PRIMERO-PRIM","SEGUNDO-PRIM","TERCER-PRIM","CUARTO-PRIM","QUINTO-PRIM","SEXTO-PRIM"];

        $cont = 0;

         while($cont!=6){
            $grado = Grado::factory()->create([
                "nombre" => $grados[$cont]
            ]);

            Seccion::factory()->create([
                'nombre' => "A",
                'grado_id' => $grado->id
            ]);

            Seccion::factory()->create([
                'nombre' => "B",
                'grado_id' => $grado->id
            ]);

             $cont++;
         }

         //ASOCIACION CON LAS SECCIONES


}

}

