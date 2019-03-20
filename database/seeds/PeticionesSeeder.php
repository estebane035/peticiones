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
      factory('App\Peticion', 25)->create();
    }
}
