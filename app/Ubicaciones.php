<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicaciones extends Model {
	protected $table = 'ubicacion';

	protected $fillable =['idUsuario','timeWhen','codPostal','long','lat','pais','comunidad','ciudad','direccion','num','piso','esc','puerta'];
}
