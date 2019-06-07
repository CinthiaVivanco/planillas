<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiporubro extends Model
{
    protected $table = 'tiporubros';
    public $timestamps=false;


    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

    public function rubro()
    {
        return $this->hasMany('App\Rubro');
    }


}
