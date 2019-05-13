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
      factory('App\Peticion', 500)->states("Seguridad Publica")->create(); //2250
      factory('App\Peticion', 175)->states("Asistencia Medica")->create(); //1730
      factory('App\Peticion', 80)->states("Proteccion Civil")->create(); //300
    }
}
