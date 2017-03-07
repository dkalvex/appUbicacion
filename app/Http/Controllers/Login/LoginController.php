<?php namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session\SessionController;
use DB;
use App\User as User;

class LoginController extends Controller{
	public function login(Request $request)
	{
		$view = "/";
		$errors = array();		
		$email = 	$request->input('email');
		$password = $request->input('password');	
		if (\Auth::attempt(['email' => $email, 'password' => $password ,'active' => 1]))
		{
			$request->session()->put('user.id',\Auth::user()->id);

			\sessionFacade::updateUserData($request);
			//\sessionFacade::updateUserProfile($request);		

			//\logFacade::log('1',\Auth::user()->id);
			return redirect($view);
		}else{
			array_push($errors,"Email ó Contraseña incorrectos");
		}

		//Errores
		if ($password == null and $password == "")
		{
			array_push($errors,"El campo contraseña es obligatorio");
		}
		if ($email == null and $email == "")
		{
			array_push($errors,"El campo email es obligatorio");
		}
		return redirect($view)->with('errors',$errors);
	}
	public function logout(Request $request)
	{
		\sessionFacade::logout($request);
		return redirect("home");
	}			
}