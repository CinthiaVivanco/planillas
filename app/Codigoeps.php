<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigoeps extends Model
{
    protected $table = 'codigoeps';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function trabajador()
    {
        return $this->hasMany('App\Trabajador');
    }

}
