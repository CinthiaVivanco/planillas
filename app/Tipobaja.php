<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipobaja extends Model
{
    protected $table = 'tipobajas';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
    public function trabajador()
    {
        return $this->hasMany('App\Derechohabiente');
    }

}
