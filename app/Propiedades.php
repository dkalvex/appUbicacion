<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propiedades extends Model   {
    use Authenticatable, CanResetPassword;

    protected $table = 'propiedades';
    protected $fillable =['id','nombre', 'valor','descripcion'];
}
