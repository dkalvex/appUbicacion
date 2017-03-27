<?php namespace App\Http\Facade;

use Illuminate\Support\Facades\Facade;
use DB;
use App\User as User;
class userFacade extends Facade{
	
	public static function getUserFaceboock($request)
	{
		$user= array();
		$user = DB::table('users')->where('users.id_faceboock',$request->input('id'))->get();
		
		if(count($user)> 0){
			$propiedades = DB::table('propiedades')->where('propiedades.nombre', 'NumMaxUbiXUser')->get();
			$request->session()->put('user.id',$user[0]->id);
			$request->session()->put('user.nombre',$user[0]->nombre);
			$request->session()->put('user.apellido',$user[0]->apellido);
			$request->session()->put('user.maxUbi',$propiedades[0]->valor);
		}
		return $user;
	}
	
	public static function saveUserFaceboock($request)
	{
		$user = DB::table('users')->where('users.email', $request->input('email'))->get();
		if(count($user)>0){	
			
			DB::table('users')
			->where('email', $request->input('email'))
			->update(['id_faceboock' => $request->input('id')]);

			$request->session()->put('user.id',$user[0]->id);
			$request->session()->put('user.nombre',$user[0]->nombre);
			$request->session()->put('user.apellido',$user[0]->apellido);

		}else{
			$user = new User;
			$user->nombre = $request->input('nombre');
			$user->email = $request->input('email');
			$user->active = 1;
			$user->id_faceboock = $request->input('id');	
			$user->save();

			$request->session()->put('user.id',$user->id);
			$request->session()->put('user.nombre',$user->nombre);
			$request->session()->put('user.apellido',$user->apellido);
		}
		$propiedades = DB::table('propiedades')->where('propiedades.nombre', 'NumMaxUbiXUser')->get();
		$request->session()->put('user.maxUbi',$propiedades[0]->valor);
	}

	public static function saveUser($request)
	{
		$user= array();
		$user = DB::table('users')->where('users.email', $request->input('email'))->get();
		if(count($user)>0){
			return "false";
		}else{
			$user = new User;
			$user->nombre = $request->input('nombre');
			$user->apellido = $request->input('apellido');
			$user->email = $request->input('email');
			$user->active = 1;
			$user->password = $request->input('password');
			$user->save();
		}
		$request->session()->put('user.id',$user->id);
		$request->session()->put('user.nombre',$user->nombre);
		$request->session()->put('user.apellido',$user->apellido);
		return "true";
	}

	public static function resetPsd($request)
	{
		$user= array();
		$user = DB::table('users')->where('users.email', $request->input('email'))->get();
		if(count($user)>0){
			DB::table('users')
			->where('email', $request->input('email'))
			->update(['password' => \Hash::make($request->input('password'))]);
			return "true";
		}
		return "false";
	}
}
