<?php namespace App\Http\Facade;

use Illuminate\Support\Facades\Facade;
use Illuminate\Http\Request;
use DB;
use App\User as User;
use App\Propiedades as Propiedades;
class sessionFacade extends Facade {
	//Aqui se optiene los datos del usuario
	public static function updateUserData(Request $request)
	{
		$status = true;
		$user = User::find($request->session()->get('user.id'));
		$propiedades = DB::table('propiedades')->where('propiedades.nombre', 'NumMaxUbiXUser')->get();
		//Si se consiguen datos del usuario se guardan en session
		if (count($user)>0){
			$request->session()->put('user.nombre',$user->nombre);
			$request->session()->put('user.apellido',$user->apellido);
			$request->session()->put('user.maxUbi',$propiedades[0]->valor);
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