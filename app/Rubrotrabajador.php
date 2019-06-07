<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubrotrabajador extends Model
{
    protected $table = 'rubrotrabajadores';
    public $timestamps=false;

    
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

    public function rubro()
    {
        return $this->belongsTo('App\Rubro');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Trabajador');
    }
    
}
