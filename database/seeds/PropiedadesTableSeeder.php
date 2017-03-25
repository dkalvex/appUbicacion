<?php

use Illuminate\Database\Seeder;

class PropiedadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$p = [
    	['nombre' => 'NumMaxUbiXUser', 'valor' => '100', 'descripcion' => 'Número máximo de ubicaciones que puede tener guardadas un usuario,']
    	];

    	\DB::table('propiedades')->insert($p);
    }
}
