<?php

use Faker\Generator as Faker;

$factory->define(App\Peticion::class, function (Faker $faker) {
    return [
      'latitud' => $faker->latitude(),
      'longitud' => $faker->longitude(),
      'tipo' =>  $faker->randomElement(["Seguridad Publica", "Asistencia Medica", "Proteccion Civil"]),
      'estatus' => $faker->randomElement(["Atendida", "No Atendida", "En Proceso"]),
    ];
});
