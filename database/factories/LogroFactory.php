<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LogroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nombre"=>$this->faker->name,
            "descripcion"=>$this->faker->realText(50),
            "tipo"=>$this->faker->randomElement(["0","1","2","3","4","5"]),
        ];
    }
}
