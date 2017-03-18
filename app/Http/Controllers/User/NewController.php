<?php namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User as User;

class NewController extends Controller
{
	public function index(Request $request)
	{
		try {
			$user = \userFacade::getUserFaceboock($request);

			$user_id = $request->session()->get('user.id');
			if ($user_id==null and $user_id==""){				
				$status = \userFacade::saveUserFaceboock($request);	
			}			
			return "Ok";
		} catch (Exception $e) {
			return "Ha ocurrido al tratar de guardar el usuario";
		}
	}

	public function saveUser(Request $request)
	{
		$error = array();
		$message = array();
		try{
			$status = \userFacade::saveUser($request);
			array_push($message,$status);
			return view('home/home')->with('message',$message);
		}catch(Exception $e){
			array_push($error,"Ocurrio un error al guardar información");
			return redirect('home/home')->with('errors',$error);
		}	
	}	
}