<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => "Esteban",
            'apellidos' => "Bocardo Medel",
            'username' => "esteban",
            'password' => bcrypt('asdasd'),
        ]);
    }
}
