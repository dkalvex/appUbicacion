<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$users = [
    	['nombre' => 'Antonio Jesus', 'email' => 'antoniojesus.hidalgo@gmail.com', 'password' => \Hash::make('123456'), 'active' => 1]
    	];

    	\DB::table('users')->insert($users);

    }
}
