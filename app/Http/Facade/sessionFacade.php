<?php namespace App\Http\Facade;

use Illuminate\Support\Facades\Facade;
use Illuminate\Http\Request;
use DB;
use App\User as User;
class sessionFacade extends Facade {
	//Aqui se optiene los datos del usuario
	public static function updateUserData(Request $request)
	{
		$status = true;
		$user = User::find($request->session()->get('user.id'));		
		//Si se consiguen datos del usuario se guardan en session
		if (count($user)>0){
			$request->session()->put('user.nombre',$user->nombre);
			$request->session()->put('user.apellido',$user->apellido);
		}else{
			$status = false;
		}
		return $status;
	}
	public static function logout(Request $request)
	{
		$request->session()->flush();	
	}
}