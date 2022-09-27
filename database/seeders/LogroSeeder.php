<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Logro;
use Database\Factories\ImageLogroFactory;
use Illuminate\Database\Seeder;


class LogroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logros = Logro::factory(10)->create();

        foreach ($logros as $l) {
            Image::factory(1)->create([
                'imageable_id' => $l->id,
                'imageable_type' => Logro::class,
            ]);
        }

    }
}
