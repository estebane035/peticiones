<?php

use Illuminate\Database\Seeder;

class PeticionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory('App\Peticion', 2250)->states("Seguridad Publica")->create();
      factory('App\Peticion', 1730)->states("Asistencia Medica")->create();
      factory('App\Peticion', 300)->states("Proteccion Civil")->create();
    }
}
