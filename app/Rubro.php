<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $table = 'rubros';
    public $timestamps=false;

    
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

    public function tiporubro()
    {
        return $this->belongsTo('App\Tiporubro');
    }
    public function rubrotrabajador()
    {
        return $this->hasMany('App\Rubrotrabajador');
    }
    
}
