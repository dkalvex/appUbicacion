<?php namespace App\Http\Facade;

use Illuminate\Support\Facades\Facade;
use DB;
use App\Ubicaciones as Ubicaciones;

class ubicacionFacade extends Facade{
	public static function getUbicaciones($id)
	{
		$ubs = array();
		$ubs = DB::table('ubicacion')->where('idUsuario',$id)->get();
		
		return $ubs;
	}

	public static function getUbicacionesCercanas($request)
	{
		$ubs = array();
		$ubs = DB::select("call appubicacion.ubicacionesCercanas(?)",[$request->input("idUbicacion")]);
		
		return $ubs;
	}

	public static function daleteUbicaciones($request)
	{
		$ubi = Ubicaciones::find($request->input("idUbicacion"));
		$ubi->delete();
	}

	public static function saveUbicacion($request)
	{		
		$date = date('Y-m-d H:i:s');
		$id = $request->input("idUbicacion");
		if($id!="" && $id!=null){
			$ub = Ubicaciones::find($request->input("idUbicacion"));
		}else{
			$ub = new Ubicaciones;
		};

		$ub->codPostal = $request->input('codPostal');
		$ub->pais = $request->input('pais');
		$ub->comunidad = $request->input('comunidad');
		$ub->ciudad = $request->input('ciudad');
		$ub->direccion = $request->input('direccion');
		$ub->num = $request->input('num');
		$ub->piso = $request->input('piso');
		$ub->esc = $request->input('esc');
		$ub->puerta = $request->input('puerta');
		$ub->lat = $request->input('lat');
		$ub->long = $request->input('long');
		$ub->idUsuario = $request->session()->get('user.id');
		$ub->timeWhen = $date;
		$ub->save();
		return $ub->id;
	}
}
