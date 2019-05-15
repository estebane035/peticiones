<?php

use Faker\Generator as Faker;

$factory->define(App\Peticion::class, function (Faker $faker) {
    return [
    	'user_id' => 1,
      	'latitud' => $faker->randomFloat(8, 20.4888926, 20.7563943),
      	'longitud' => $faker->randomFloat(8, -103.4606375, -103.2112008),
      	'estatus' => $faker->randomElement(["Atendida", "No Atendida", "En Proceso"]),
      	'created_at' => $faker->dateTimeBetween('-14 days','now'),
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
