<?php namespace App\Http\Controllers\Ubicacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UbicacionController extends Controller
{
	public function getUbicaciones(Request $request)
	{	
		try {
			$ubs = \ubicacionFacade::getUbicaciones($request->session()->get('user.id'));
			return $ubs;
		} catch (Exception $e) {
			array_push($error,"Ha ocurrido al tratar de consultar");
			//echo 'Error en consultar',  $e->getMessage(), "\n";
			return $error;
		}
	}
	public function getUbicacionesCercanas(Request $request)
	{
		try {
			$ubs = \ubicacionFacade::getUbicacionesCercanas($request);
			return $ubs;
		} catch (Exception $e) {
			array_push($error,"Ha ocurrido al tratar de consultar");
			//echo 'Error en consultar',  $e->getMessage(), "\n";
			return $error;
		}
	}

	public function saveUbicacion(Request $request)
	{
		$error = array();
		$message = array();
		try{			
			$ubs = DB::table('ubicacion')->where('idUsuario',$request->session()->get('user.id'))->get();
			if(count($ubs) > (int) $request->session()->get('user.maxUbi')){
				return "false";
			}else{
				$ubi = \ubicacionFacade::saveUbicacion($request);			
				return $ubi;
			}
			
		}catch(Exception $e){
			return "error";
		}
	}

	public function deleteUbicacion(Request $request)
	{
		$error = array();
		$message = array();
		try {
			\ubicacionFacade::daleteUbicaciones($request);
			array_push($message,"La ubicacion fue guardada exitosamente");
			return $message;
		} catch (Exception $e) {
			array_push($error,"Ha ocurrido al tratar de guardar");
			return $error;
		}
	}
}