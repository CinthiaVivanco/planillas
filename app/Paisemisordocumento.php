<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paisemisordocumento extends Model
{
    protected $table = 'paisemisordocumentos';
    public $timestamps=false;

    
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

    public function trabajador()
    {
        return $this->hasMany('App\Trabajador');
    }

    public function derechohabiente()
    {
        return $this->hasMany('App\Derechohabiente');
    }


    
}



