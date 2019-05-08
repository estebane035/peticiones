<?php

use Faker\Generator as Faker;

$factory->define(App\Peticion::class, function (Faker $faker) {
    return [
    	'user_id' => 1,
      	'latitud' => $faker->numberBetween(20.7563943,20.6160891),
      	'longitud' => $faker->numberBetween(-103.4606375,-103.2112008),
      	'estatus' => $faker->randomElement(["Atendida", "No Atendida", "En Proceso"]),
    ];
});

$factory->state(App\Peticion::class, 'Seguridad Publica', function (\Faker\Generator $faker) {
  return [
    'tipo' => "Seguridad Publica",
  ];
});

$factory->state(App\Peticion::class, 'Asistencia Medica', function (\Faker\Generator $faker) {
  return [
    'tipo' => "Asistencia Medica",
  ];
});

$factory->state(App\Peticion::class, 'Proteccion Civil', function (\Faker\Generator $faker) {
  return [
    'tipo' => "Proteccion Civil",
  ];
});