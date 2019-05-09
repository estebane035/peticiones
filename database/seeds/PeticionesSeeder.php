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
      factory('App\Peticion', 22)->states("Seguridad Publica")->create(); //2250
      factory('App\Peticion', 17)->states("Asistencia Medica")->create(); //1730
      factory('App\Peticion', 30)->states("Proteccion Civil")->create(); //300
    }
}
